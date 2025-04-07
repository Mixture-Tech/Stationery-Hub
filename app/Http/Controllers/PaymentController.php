<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Province;
use App\Models\District;
use App\Models\Area;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // Thanh toán trực tiếp từ chi tiết sản phẩm
    public function directPayment(Request $request)
    {
        $id_product = $request->input('id_product');
        $quantity = $request->input('quantity', 1); // Mặc định là 1 nếu không có số lượng

        $product = Product::findOrFail($id_product);
        $total_price = $product->discount_price * $quantity;

        // Truyền dữ liệu sang trang thanh toán
        $items = [
            [
                'product' => $product,
                'discount_price' => $product->discount_price,
                'quantity' => $quantity,
                'total_price' => $total_price,
            ]
        ];
        // Kiểm tra số lượng sản phẩm có đủ không
        if ($product->nums < $quantity) {
            return redirect()->back()->with('error', 'Số lượng yêu cầu cho ' . $quantity . ' không có sẵn!');
        }

        $provinces = Province::all();
        $districts = District::all();

        return view('payment.index', [
            'items' => $items,
            'subtotal' => $total_price,
            'shipping_fee' => 0, // Phí giao hàng cố định, có thể thay đổi
            'total' => $total_price,
            'from_cart' => false,
            'provinces' => $provinces,
            'districts' => $districts,
        ]);
    }

    public function cartPayment(Request $request)
    {
        $cartIds = $request->input('cart_ids', []);
        if (empty($cartIds)) {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất một sản phẩm để thanh toán!');
        }

        session(['selected_cart_ids' => $cartIds]);

        $cartItems = Cart::whereIn('id', $cartIds)->with('product')->get();
        $items = $cartItems->map(function ($item) {
            return [
                'product' => $item->product,
                'discount_price' => $item->product->discount_price,
                'quantity' => $item->quantity,
                'total_price' => $item->total_price,
            ];
        })->toArray();

        $subtotal = $cartItems->sum('total_price');

        $provinces = Province::all();
        $districts = District::all();

        return view('payment.index', [
            'items' => $items,
            'subtotal' => $subtotal,
            'shipping_fee' => 0,
            'total' => $subtotal,
            'from_cart' => true,
            'cart_ids' => $cartIds, // Để xóa sau khi đặt hàng thành công
            'provinces' => $provinces,
            'districts' => $districts,
        ]);
    }

    // Trang thanh toán chung
    public function index()
    {
        $provinces = Province::all();
        $districts = District::all();
        return view('payment.index', [
            'provinces' => $provinces,
            'districts' => $districts,
        ]);
    }

    public function processPayment(Request $request)
    {
        // Validate dữ liệu từ form
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'id_province' => 'required|exists:provinces,id_province',
            'id_district' => 'required|exists:districts,id_district',
            'address' => 'required|string|max:255',
            'payment_methods' => 'required|in:COD,momo',
            'items' => 'required|array',
            'items.*.id_product' => 'required|exists:products,id_product',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.total_price' => 'required|numeric|min:0',
        ]);

        foreach($request->items as $item){
            $product = Product::find($item['id_product']);
            if(!$product || $product->nums < $item['quantity']){
                return redirect()->back()->with('error', 'Số lượng yêu cầu cho ' . $item['quantity'] . ' không có sẵn!');
            }
        }

        $district = District::findOrFail($request->id_district);
        $id_province = $district->id_province;

        $province = Province::findOrFail($id_province);
        $id_area = $province->id_area;

        // Tính tổng tiền và phí giao hàng
        $subtotal = collect($request->items)->sum('total_price');
        $shipping_fee = District::find($request->id_district)->fee ?? 0;
        $total = $subtotal + $shipping_fee;

        // Lưu thông tin khách hàng vào session để hiển thị ở trang success
        session([
            'order_customer_info' => [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ]
        ]);

        if ($request->payment_methods == 'momo') {
            // Chuyển sang controller MoMo để xử lý
            $momoController = app(MomoPaymentController::class);
            return $momoController->processPayment($request, $total, $request->items);
        }

        // Xử lý thanh toán COD
        $order = Order::create([
            'id_user' => Auth::id(),
            'id_district' => $request->id_district,
            'id_province' => $id_province,
            'id_area' => $id_area,
            'total_price' => $total,
            'status' => 'Pending',
            'payment_methods' => $request->payment_methods,
        ]);

        // Lưu chi tiết đơn hàng
        foreach ($request->items as $item) {
            OrderDetail::create([
                'id_order' => $order->id_order,
                'id_product' => $item['id_product'],
                'quantity' => $item['quantity'],
                'total_product' => $item['total_price'],
                'id_district' => $request->id_district,
                'id_province' => $id_province,
                'id_area' => $id_area,
            ]);

            // Cập nhật số lượng sản phẩm trong kho
            $product = Product::find($item['id_product']);
            if ($product) {
                // Đảm bảo số lượng không bị âm
                $newQuantity = max(0, $product->nums - $item['quantity']);
                $product->nums = $newQuantity;
                $product->save();
            }
        }

        // Nếu thanh toán từ giỏ hàng, xóa các sản phẩm đã chọn
        $from_cart = $request->input('from_cart', false);
        if ($from_cart && session()->has('selected_cart_ids')) {
            $cart_ids = session('selected_cart_ids');
            if (!empty($cart_ids)) {
                Cart::whereIn('id', $cart_ids)
                    ->where('id_user', Auth::id())
                    ->delete();
            }
            session()->forget('selected_cart_ids');
        }

        // Chuyển hướng đến trang thành công
        return redirect()->route('payment.success', ['order_id' => $order->id_order])
                         ->with('success', 'Đơn hàng đã được đặt thành công!');
    }

    public function success(Request $request, $order_id)
    {
        // Tìm đơn hàng theo id_order hoặc momo_order_id
        $order = Order::with(['orderDetails.product', 'province', 'district'])
                    ->where(function($query) use ($order_id) {
                        $query->where('id_order', $order_id)
                              ->orWhere('momo_order_id', $order_id);
                    })
                    ->where('id_user', Auth::id())
                    ->first();

        // Lấy thông tin khách hàng từ session
        $customer_info = session('order_customer_info', []);

        if (!$order && session('pending_order.order_id') === $order_id) {
            // Hiển thị thông tin tạm từ session nếu đơn hàng chưa được tạo
            $pendingOrder = session('pending_order');
            return view('payment.success', [
                'order' => (object)[
                    'id_order' => $order_id,
                    'total_price' => $pendingOrder['total_price'],
                    'payment_methods' => 'momo',
                    'district' => District::find($pendingOrder['id_district']),
                    'province' => Province::find($pendingOrder['id_province'])
                ],
                'customer_info' => $customer_info
            ]);
        }

        if (!$order) {
            abort(404, 'Đơn hàng không tồn tại.');
        }

        return view('payment.success', compact('order', 'customer_info'));
    }
}