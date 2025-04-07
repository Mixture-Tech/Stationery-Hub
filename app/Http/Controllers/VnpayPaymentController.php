<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\Province;
use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VnpayPaymentController extends Controller
{
    // Cấu hình VNPAY
    private $vnp_TmnCode = "8SRWHN4Z"; // Mã website tại VNPAY
    private $vnp_HashSecret = "88Z0XS934817F0RCQMP02MWY3EYHQM4P"; // Chuỗi bí mật
    private $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // URL thanh toán - sandbox
    private $vnp_ReturnUrl = ""; // URL callback - sẽ được set động

    // Xử lý thanh toán qua VNPAY
    public function vnpayPayment(Request $request, $total, $items)
    {
        Log::info('VNPAY Payment Process Started', ['total' => $total]);

        // Thiết lập URL callback
        $this->vnp_ReturnUrl = route('payment.vnpay.callback');

        // Tạo mã đơn hàng
        $orderId = time() . "_" . Auth::id();

        // Chuyển đổi total sang định dạng số nguyên và nhân 100
        $amount = $total * 100000; // VNPAY yêu cầu số tiền phải là số nguyên (đơn vị đồng)

        // Tạo dữ liệu đặt hàng tạm thời và lưu vào session
        $district = District::findOrFail($request->id_district);
        $id_province = $district->id_province;
        $province = Province::findOrFail($id_province);
        $id_area = $province->id_area;

        session([
            'pending_order' => [
                'id_user' => Auth::id(),
                'id_district' => $request->id_district,
                'id_province' => $id_province,
                'id_area' => $id_area,
                'total_price' => $total,
                'payment_methods' => 'vnpay',
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

        // Xây dựng dữ liệu thanh toán VNPAY
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $this->vnp_TmnCode,
            "vnp_Amount" => $amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $request->ip(),
            "vnp_Locale" => "vn", // Ngôn ngữ hiển thị
            "vnp_BankCode" => "NCB", // Mã ngân hàng (nếu có)
            "vnp_OrderInfo" => "Thanh toan don hang Stationery Hub qua VNPAY", // Thông tin đơn hàng
            "vnp_OrderType" => "qr", // Loại hình thanh toán
            "vnp_ReturnUrl" => $this->vnp_ReturnUrl,
            "vnp_TxnRef" => $orderId,
        ];

        // Thêm thông tin người dùng (không bắt buộc)
        // $inputData["vnp_Bill_FirstName"] = $request->name;
        // $inputData["vnp_Bill_Email"] = $request->email;
        // $inputData["vnp_Bill_Mobile"] = $request->phone;
        // $inputData["vnp_Bill_Address"] = $request->address;

        // if(isset($vnp_BankCode) && ($vnp_BankCode != "")) {
        //     $inputData['vnp_BankCode'] = $vnp_BankCode;
        // }
        // if(isset($vnp_Locale) && ($vnp_Locale != "")) {
        //     $inputData['vnp_Locale'] = $vnp_Locale;
        // }

        Log::info('VNPAY Payment Data Bank Code: ', $inputData);

        // Sắp xếp dữ liệu theo thứ tự từ điển và tạo chuỗi hash
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        // Thêm chữ ký số
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $this->vnp_HashSecret);
        $query .= 'vnp_SecureHash=' . $vnpSecureHash;

        // Tạo URL thanh toán
        $paymentUrl = $this->vnp_Url . "?" . $query;

        Log::info('VNPAY Payment URL Created', ['url' => $paymentUrl]);

        // Chuyển hướng đến trang thanh toán VNPAY
        return redirect()->to($paymentUrl);
    }

    // Xử lý callback từ VNPAY
    public function callback(Request $request)
    {
        Log::info('VNPAY Callback', $request->all());

        // Lấy dữ liệu từ VNPAY gửi về
        $inputData = $request->all();
        $vnp_SecureHash = $request->vnp_SecureHash;
        $orderId = $request->vnp_TxnRef;
        $vnp_ResponseCode = $request->vnp_ResponseCode;
        $vnp_TransactionStatus = $request->vnp_TransactionStatus;
        $amount = $request->vnp_Amount / 100; // Chuyển về đơn vị tiền tệ thực

        // Xóa vnp_SecureHash để tạo chuỗi hash mới
        unset($inputData['vnp_SecureHash']);
        
        // Sắp xếp dữ liệu theo thứ tự từ điển
        ksort($inputData);
        
        // Tạo chuỗi hash để kiểm tra
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                if ($i == 1) {
                    $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }
        }
        
        // Tạo chữ ký số
        $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
        
        // Kiểm tra chữ ký số
        if ($secureHash !== $vnp_SecureHash) {
            Log::error('VNPAY Callback: Invalid signature');
            return redirect()->route('products.index')
                            ->with('error', 'Dữ liệu không hợp lệ từ VNPAY!');
        }

        // Lấy thông tin đơn hàng tạm thời từ session
        $pendingOrder = session('pending_order');
        
        // Kiểm tra đơn hàng tạm thời
        if (!$pendingOrder || $pendingOrder['order_id'] !== $orderId) {
            Log::error('VNPAY Callback: Order not found in session', [
                'order_id' => $orderId,
                'pending_order' => $pendingOrder
            ]);
            return redirect()->route('products.index')
                            ->with('error', 'Không tìm thấy thông tin đơn hàng!');
        }

        // Xử lý theo trạng thái thanh toán
        if ($vnp_ResponseCode == "00" && $vnp_TransactionStatus == "00") {
            // Thanh toán thành công
            Log::info('VNPAY Payment Successful', ['order_id' => $orderId]);
            
            // Tạo đơn hàng mới trong database
            $order = Order::create([
                'id_user' => $pendingOrder['id_user'],
                'id_district' => $pendingOrder['id_district'],
                'id_province' => $pendingOrder['id_province'],
                'id_area' => $pendingOrder['id_area'],
                'total_price' => $pendingOrder['total_price'],
                'status' => 'Pending',
                'payment_methods' => 'vnpay',
                'vnpay_order_id' => $orderId,
                'vnpay_transaction_id' => $request->vnp_TransactionNo ?? null,
            ]);

            // Tạo chi tiết đơn hàng
            foreach ($pendingOrder['items'] as $item) {
                OrderDetail::create([
                    'id_order' => $order->id_order,
                    'id_product' => $item['id_product'],
                    'quantity' => $item['quantity'],
                    'total_product' => $item['total_price'],
                    'id_district' => $pendingOrder['id_district'],
                    'id_province' => $pendingOrder['id_province'],
                    'id_area' => $pendingOrder['id_area'],
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

            // Lưu thông tin khách hàng vào session để hiển thị ở trang thành công
            session(['order_customer_info' => $pendingOrder['customer_info']]);
            session()->forget('pending_order');
            
            // Chuyển hướng đến trang thành công
            return redirect()->route('payment.success', ['order_id' => $order->id_order])
                            ->with('success', 'Đơn hàng đã được thanh toán thành công!');
        } else {
            // Thanh toán thất bại
            Log::error('VNPAY Payment Failed', [
                'order_id' => $orderId,
                'response_code' => $vnp_ResponseCode,
                'transaction_status' => $vnp_TransactionStatus
            ]);
            
            // Xóa đơn hàng tạm thời
            session()->forget('pending_order');
            
            // Chuyển hướng về trang sản phẩm với thông báo lỗi
            return redirect()->route('products.index')
                            ->with('error', 'Thanh toán không thành công: ' . $this->getVnpayErrorMessage($vnp_ResponseCode));
        }
    }

    // Xử lý IPN (Instant Payment Notification) từ VNPAY
    public function ipn(Request $request)
    {
        Log::info('VNPAY IPN', $request->all());
        
        // Lấy dữ liệu từ VNPAY gửi về
        $inputData = $request->all();
        $vnp_SecureHash = $request->vnp_SecureHash;
        
        // Xóa vnp_SecureHash để tạo chuỗi hash mới
        unset($inputData['vnp_SecureHash']);
        
        // Sắp xếp dữ liệu theo thứ tự từ điển
        ksort($inputData);
        
        // Tạo chuỗi hash để kiểm tra
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                if ($i == 1) {
                    $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashData .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
            }
        }
        
        // Tạo chữ ký số
        $secureHash = hash_hmac('sha512', $hashData, $this->vnp_HashSecret);
        
        // Kiểm tra chữ ký số
        if ($secureHash !== $vnp_SecureHash) {
            Log::error('VNPAY IPN: Invalid signature');
            return response()->json([
                'RspCode' => '97',
                'Message' => 'Invalid signature'
            ]);
        }
        
        $orderId = $request->vnp_TxnRef;
        $vnp_ResponseCode = $request->vnp_ResponseCode;
        $vnp_TransactionStatus = $request->vnp_TransactionStatus;
        $amount = $request->vnp_Amount / 100;
        
        // Kiểm tra xem đơn hàng đã được tạo chưa
        $existingOrder = Order::where('vnpay_order_id', $orderId)->first();
        
        if ($existingOrder) {
            Log::info('VNPAY IPN: Order already exists', ['order_id' => $existingOrder->id_order]);
            return response()->json([
                'RspCode' => '02',
                'Message' => 'Order already confirmed'
            ]);
        }
        
        // Nếu thanh toán thành công
        if ($vnp_ResponseCode == "00" && $vnp_TransactionStatus == "00") {
            // Tương tự như xử lý callback, nhưng đây là xử lý server-to-server
            // Trong thực tế, bạn nên cập nhật trạng thái đơn hàng
            Log::info('VNPAY IPN: Payment successful, should process order in background');
            
            return response()->json([
                'RspCode' => '00',
                'Message' => 'Confirm Success'
            ]);
        } else {
            Log::error('VNPAY IPN: Payment failed', [
                'response_code' => $vnp_ResponseCode,
                'transaction_status' => $vnp_TransactionStatus
            ]);
            
            return response()->json([
                'RspCode' => '99',
                'Message' => 'Payment failed'
            ]);
        }
    }

    // Hàm lấy thông báo lỗi từ mã lỗi VNPAY
    private function getVnpayErrorMessage($responseCode)
    {
        $errorMessages = [
            '01' => 'Giao dịch đã tồn tại',
            '02' => 'Merchant không hợp lệ',
            '03' => 'Dữ liệu gửi sang không đúng định dạng',
            '04' => 'Khởi tạo GD không thành công do Website đang bị tạm khóa',
            '05' => 'Giao dịch không thành công do: Quý khách nhập sai mật khẩu thanh toán quá số lần quy định',
            '06' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực',
            '07' => 'Trừ tiền thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường)',
            '09' => 'Giao dịch không thành công do: Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking',
            '10' => 'Giao dịch không thành công do: Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần',
            '11' => 'Giao dịch không thành công do: Đã hết hạn chờ thanh toán',
            '12' => 'Giao dịch không thành công do: Thẻ bị khóa',
            '13' => 'Giao dịch không thành công do Quý khách nhập sai mật khẩu xác thực',
            '24' => 'Giao dịch không thành công do: Khách hàng hủy giao dịch',
            '51' => 'Giao dịch không thành công do: Tài khoản không đủ số dư để thực hiện giao dịch',
            '65' => 'Giao dịch không thành công do: Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày',
            '75' => 'Ngân hàng thanh toán đang bảo trì',
            '79' => 'Giao dịch không thành công do: KH nhập sai mật khẩu thanh toán nhiều lần',
            '99' => 'Lỗi không xác định',
        ];
        
        return isset($errorMessages[$responseCode]) ? $errorMessages[$responseCode] : 'Lỗi không xác định';
    }
}