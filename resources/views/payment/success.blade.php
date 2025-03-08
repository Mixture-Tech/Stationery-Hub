<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Thành Công - Stationery</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('components.global.navbar')
    
    <div class="container w-3/5 mx-auto py-6 px-4">
        <div class="bg-white p-6 rounded-lg shadow-md text-center">
            <svg class="mx-auto mb-4 w-16 h-16 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
            <h2 class="text-2xl font-bold text-green-600">Thanh Toán Thành Công!</h2>
            <p class="text-gray-700 mt-2">Cảm ơn bạn đã mua sắm tại Stationery - Hub. Đơn hàng của bạn sẽ được xử lý và giao trong thời gian sớm nhất.</p>
            
            <div class="mt-6 text-left border-t pt-4 mb-4">
                <h3 class="text-lg font-semibold">Chi Tiết Đơn Hàng</h3>
                <p class="text-gray-700">Mã đơn hàng: <strong>#123456</strong></p>
                <p class="text-gray-700">Tên người đặt: <strong>Nguyễn Văn A</strong></p>
                <p class="text-gray-700">Số điện thoại: <strong>0987 654 321</strong></p>
                <p class="text-gray-700">Địa chỉ: <strong>123 Đường ABC, Quận XYZ, TP.HCM</strong></p>
                <p class="text-gray-700">Phương thức thanh toán: <strong>Chuyển khoản ngân hàng</strong></p>
                <p class="text-gray-700">Tổng tiền: <strong>95.500 VND</strong></p>
            </div>
            
            <x-product.product-button variant="primary" class="w-full">
                    Tiếp tục mua sắp
                </x-product.product-button>
        </div>
    </div>
    
    @include('components.global.footer')
</body>
</html>