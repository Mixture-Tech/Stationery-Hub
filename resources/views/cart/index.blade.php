<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng - Fahasa.com</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('components.global.navbar')

    <div class="container w-4/5 mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b-4 border-gray-200">
                <h1 class="text-2xl font-bold">Giỏ Hàng</h1>
            </div>

            <div class="flex flex-col md:flex-row">
                <!-- Left Column: Cart Items -->
                <div class="w-full md:w-2/3 p-4">
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="select-all" class="mr-2">
                            <label for="select-all" class="text-sm">Chọn tất cả (3 sản phẩm)</label>
                        </div>
                        <button class="text-sm text-navy">Xóa</button>
                    </div>

                    <div class="flex items-center border-b-2 border-gray-200 py-4">
                        <input type="checkbox" class="mr-4">
                        <img src="{{ Vite::asset('resources/images/products/product_1.jpg') }}" alt="Dao Rọc Giấy" class="w-20 h-20 object-cover mr-4">
                        <div class="flex-grow">
                            <p class="font-medium">Dao Rọc Giấy Deli 2031</p>
                            <p class="text-sm text-gray-500">18.500VND</p>
                        </div>
                        <x-product.quantity-button />
                        <div class="font-medium w-20 text-right ms-4">166.500VND</div>
                        <button class="ml-4 text-gray-400 hover:text-navy">
                            <x-icon name="trash"/>
                        </button>
                    </div>
                    
                    <div class="flex justify-between items-center mt-4 text-sm">
                        <x-product.product-button variant="outline">
                            Tiếp tục xem sản phẩm
                        </x-home.product.product-button>
                        <x-product.product-button variant="secondary">
                            Cập nhật giỏ hàng
                        </x-home.product.product-button>
                    </div>
                </div>

                <!-- Right Column: Order Summary -->
                <div class="w-full md:w-1/3 bg-gray-50 p-4 border-l-4 border-gray-200">
                    <h3 class="font-semibold mb-4">TỔNG CỘNG GIỎ HÀNG</h3>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span>198.300VND</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Giao hàng</span>
                            <span>Tùy chọn giao hàng sẽ được cập nhật</span>
                        </div>
                    </div>
                    <div class="border-t-2 border-gray-200 pt-2 mb-4">
                        <div class="flex justify-between font-bold">
                            <span>Tổng</span>
                            <span class="text-navy">233.300VND</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">(Đã bao gồm VAT nếu có)</p>
                    </div>
                    <x-product.product-button variant="primary" class="w-full">
                        Tiến hành thanh toán
                    </x-home.product.product-button>
                </div>
            </div>
        </div>
    </div>

    @include('components.global.footer')
</body>
</html>