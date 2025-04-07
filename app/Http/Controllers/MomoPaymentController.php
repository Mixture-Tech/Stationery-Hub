<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Province;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MomoPaymentController extends Controller
{
    protected $partnerCode = 'MOMOBKUN20180529';
    protected $accessKey = 'klm05TvNBzhg7h7j';
    protected $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    protected $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    public function processPayment(Request $request, $amount, $items)
    {
        // Chuyển tổng tiền thành số nguyên
        $originalAmount = $amount;
        $amount = (int) round($amount * 10);
        $amount = (string) intval($amount);

        $orderInfo = "Thanh toán đơn hàng Stationery Hub qua ATM MoMo";
        $orderId = time() . "_" . Auth::id();
        
        // Sử dụng route mới cho callback
        $redirectUrl = route('payment.momo.callback');
        $ipnUrl = route('payment.momo.ipn');

        $district = District::findOrFail($request->id_district);
        $id_province = $district->id_province;
        $province = Province::findOrFail($id_province);
        $id_area = $province->id_area; // Lấy id_area từ Province
        
        $extraData = base64_encode(json_encode([
            'items' => $items,
            'customer_info' => [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
            ],
            'id_district' => $request->id_district,
            'id_province' => $id_province,
            'id_area' => $id_area,
            'from_cart' => $request->input('from_cart', false)
        ]));

        $requestId = time() . "";
        $requestType = "payWithATM";

        // Tạo chữ ký
        $rawHash = "accessKey=" . $this->accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $this->partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;        
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        $data = array(
            'partnerCode' => $this->partnerCode,
            'partnerName' => "Stationery Hub",
            "storeId" => "StationeryHubMomo",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        
        Log::info('MoMo Request Data', $data);
        
        $result = $this->execPostRequest($this->endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);  // decode json
        
        Log::info('MoMo Response', $jsonResult);

        if (isset($jsonResult['payUrl'])) {
            // Lưu tạm thông tin đơn hàng vào session để xử lý sau khi MoMo xác nhận
            session([
                'pending_order' => [
                    'id_user' => Auth::id(),
                    'id_district' => $request->id_district,
                    'id_province' => $id_province,
                    'id_area' => $id_area,
                    'total_price' => $originalAmount,
                    'payment_methods' => 'momo',
                    'items' => $items,
                    'order_id' => $orderId,
                    'customer_info' => [
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'address' => $request->address,
                    ],
                    'from_cart' => $request->input('from_cart', false)
                ]
            ]);
            return redirect()->to($jsonResult['payUrl']);
        }

        return redirect()->back()->with('error', 'Không thể tạo yêu cầu thanh toán MoMo: ' . ($jsonResult['message'] ?? 'Lỗi không xác định'));
    }

    public function callback(Request $request)
    {
        Log::info('MoMo Callback', $request->all());
        
        $orderId = $request->orderId;
        $resultCode = $request->resultCode;
        
        if ($resultCode == 0) { // Thanh toán thành công
            $pendingOrder = session('pending_order');
            if ($pendingOrder && $pendingOrder['order_id'] === $orderId) {
                // Lấy id_area từ Province nếu không có trong pendingOrder
                $id_area = $pendingOrder['id_area'];
                if (!$id_area) {
                    $province = Province::find($pendingOrder['id_province']);
                    $id_area = $province ? $province->id_area : null; // Gán id_area từ Province
                }

                $order = Order::create([
                    'id_user' => $pendingOrder['id_user'],
                    'id_district' => $pendingOrder['id_district'],
                    'id_province' => $pendingOrder['id_province'],
                    'id_area' => $id_area, // Sử dụng id_area đã tính toán
                    'total_price' => $pendingOrder['total_price'],
                    'status' => 'Pending',
                    'payment_methods' => 'momo',
                    'momo_order_id' => $orderId,
                ]);

                foreach ($pendingOrder['items'] as $item) {
                    OrderDetail::create([
                        'id_order' => $order->id_order,
                        'id_product' => $item['id_product'],
                        'quantity' => $item['quantity'],
                        'total_product' => $item['total_price'],
                        'id_district' => $pendingOrder['id_district'],
                        'id_province' => $pendingOrder['id_province'],
                        'id_area' => $id_area, // Sử dụng id_area đã tính toán
                    ]);

                    // Cập nhật số lượng sản phẩm
                    $product = Product::find($item['id_product']);
                    if ($product) {
                        $newQuantity = max(0, $product->nums - $item['quantity']);
                        $product->nums = $newQuantity;
                        $product->save();
                    }
                }

                // Nếu thanh toán từ giỏ hàng, xóa các sản phẩm đã chọn
                if ($pendingOrder['from_cart'] && session()->has('selected_cart_ids')) {
                    $cart_ids = session('selected_cart_ids');
                    if (!empty($cart_ids)) {
                        Cart::whereIn('id', $cart_ids)
                            ->where('id_user', Auth::id())
                            ->delete();
                    }
                    session()->forget('selected_cart_ids');
                }

                session(['order_customer_info' => $pendingOrder['customer_info']]);
                session()->forget('pending_order');
                
                return redirect()->route('payment.success', ['order_id' => $order->id_order])
                                ->with('success', 'Đơn hàng đã được thanh toán thành công!');
            }
        }
        
        return redirect()->route('products.index')
                        ->with('error', 'Thanh toán không thành công: ' . ($request->message ?? 'Lỗi không xác định'));
    }

    // Hàm xử lý IPN từ MoMo
    public function ipn(Request $request)
    {
        Log::info('MoMo IPN', $request->all());
        
        // Xác thực chữ ký
        $rawHash = "accessKey=" . $request->accessKey . "&amount=" . $request->amount . "&extraData=" . $request->extraData . "&message=" . $request->message . "&orderId=" . $request->orderId . "&orderInfo=" . $request->orderInfo . "&orderType=" . $request->orderType . "&partnerCode=" . $request->partnerCode . "&payType=" . $request->payType . "&requestId=" . $request->requestId . "&responseTime=" . $request->responseTime . "&resultCode=" . $request->resultCode . "&transId=" . $request->transId;
        $signature = hash_hmac("sha256", $rawHash, $this->secretKey);

        if ($signature !== $request->signature) {
            Log::error('MoMo IPN: Invalid signature');
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        if ($request->resultCode == 0) { // Thanh toán thành công
            $orderId = $request->orderId;
            
            // Kiểm tra xem đơn hàng đã được tạo chưa
            $existingOrder = Order::where('momo_order_id', $orderId)->first();
            if ($existingOrder) {
                Log::info('MoMo IPN: Order already exists', ['order_id' => $existingOrder->id_order]);
                return response()->json(['status' => 'success']);
            }
            
            $pendingOrder = session('pending_order');
            $extraData = json_decode(base64_decode($request->extraData), true);
            
            // Nếu có dữ liệu từ session
            if ($pendingOrder && $pendingOrder['order_id'] === $orderId) {
                Log::info('MoMo IPN: Processing order from session', $pendingOrder);
                
                $order = Order::create([
                    'id_user' => $pendingOrder['id_user'],
                    'id_district' => $pendingOrder['id_district'],
                    'id_province' => $pendingOrder['id_province'],
                    'id_area' => $pendingOrder['id_area'] ?? null,
                    'total_price' => $pendingOrder['total_price'],
                    'status' => 'Pending',
                    'payment_methods' => 'momo',
                    'momo_order_id' => $orderId,
                ]);

                foreach ($pendingOrder['items'] as $item) {
                    OrderDetail::create([
                        'id_order' => $order->id_order,
                        'id_product' => $item['id_product'],
                        'quantity' => $item['quantity'],
                        'total_product' => $item['total_price'],
                        'id_district' => $pendingOrder['id_district'],
                        'id_province' => $pendingOrder['id_province'],
                        'id_area' => $pendingOrder['id_area'] ?? null,
                    ]);

                    $product = Product::find($item['id_product']);
                    $newQuantity = max(0, $product->nums - $item['quantity']);
                    $product->nums = $newQuantity;
                    $product->save();
                }

                session(['order_customer_info' => $pendingOrder['customer_info']]);
                session()->forget('pending_order');
            }
            // Hoặc từ extraData trong request
            elseif ($extraData && isset($extraData['items'])) {
                Log::info('MoMo IPN: Processing order from extraData', $extraData);
                
                $order = Order::create([
                    'id_user' => Auth::id(),
                    'id_district' => $extraData['id_district'],
                    'id_province' => $extraData['id_province'],
                    'id_area' => $extraData['id_area'] ?? null,
                    'total_price' => $request->amount,
                    'status' => 'Pending',
                    'payment_methods' => 'momo',
                    'momo_order_id' => $orderId,
                ]);

                foreach ($extraData['items'] as $item) {
                    OrderDetail::create([
                        'id_order' => $order->id_order,
                        'id_product' => $item['id_product'],
                        'quantity' => $item['quantity'],
                        'total_product' => $item['total_price'],
                        'id_district' => $extraData['id_district'],
                        'id_province' => $extraData['id_province'],
                        'id_area' => $extraData['id_area'] ?? null,
                    ]);

                    $product = Product::find($item['id_product']);
                    if ($product) {
                        $newQuantity = max(0, $product->nums - $item['quantity']);
                        $product->nums = $newQuantity;
                        $product->save();
                    }
                }

                session(['order_customer_info' => $extraData['customer_info']]);
            }
            else{
                Log::error('MoMo IPN: Pending order not found or mismatched', [
                    'pending_order' => $pendingOrder,
                    'request_order_id' => $orderId
                ]);
            }
        } else {
            Log::error('MoMo IPN: Payment failed', ['resultCode' => $request->resultCode, 'message' => $request->message]);
        }

        return response()->json(['status' => 'success']);
    }

    protected function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
}