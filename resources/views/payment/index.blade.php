<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán - Stationery Hub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    @include('components.global.navbar')

    <div class="container w-4/5 mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b-4 border-gray-200">
                <h1 class="text-2xl font-bold">Thanh Toán</h1>
            </div>

            <div class="flex flex-col md:flex-row">
                <!-- Left Column -->
                <div class="w-full md:w-2/3 p-4">
                <h2 class="text-lg font-semibold mb-4">THÔNG TIN THANH TOÁN</h2>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block text-gray-700">Họ và tên *</label>
                            <input type="text" class="w-full p-2 border rounded" placeholder="Nhập họ và tên">
                        </div>
                        <div>
                            <label class="block text-gray-700">Tỉnh/Thành phố *</label>
                            <select class="w-full p-2 border rounded">
                                <option>Chọn một tùy chọn...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Số điện thoại *</label>
                            <input type="text" class="w-full p-2 border rounded" placeholder="Nhập số điện thoại">
                        </div>
                        <div>
                            <label class="block text-gray-700">Quận/Huyện *</label>
                            <select class="w-full p-2 border rounded">
                                <option>Chọn quận/huyện...</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Địa chỉ email *</label>
                            <input type="email" class="w-full p-2 border rounded" placeholder="Nhập địa chỉ Email">
                        </div>
                        <div>
                            <label class="block text-gray-700">Địa chỉ *</label>
                            <input type="text" class="w-full p-2 border rounded" placeholder="Tòa nhà, số nhà, tên đường">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700">Ghi chú đơn hàng (tùy chọn)</label>
                        <textarea class="w-full p-2 border rounded" placeholder="Ghi chú về đơn hàng..."></textarea>
                    </div>
                </form>
                </div>

                <!-- Right Column -->
                <div class="w-full md:w-1/3 p-4 border-l-4 border-gray-200">
                    <h3 class="font-semibold mb-4">ĐƠN HÀNG CỦA BẠN</h3>
                    <div class="border-b pb-2 mb-2">
                    <p>Bìa 2 còng kiếng 5F - A4 × 1 <span class="float-right">45.000VND</span></p>
                    <p>Kệ rổ 1 ngăn × 1 <span class="float-right">15.500VND</span></p>
                </div>
                <p class="mb-2">Tạm tính <span class="float-right">60.500VND</span></p>
                <p class="mb-2">Giao hàng <span class="float-right">35.000VND</span></p>
                <p class="font-semibold text-lg">Tổng <span class="float-right">95.500VND</span></p>
                
                    <!-- Phương thức thanh toán -->
                    <div class="mt-6">
                    <label class="flex items-center mb-2">
                        <input type="radio" name="payment" checked class="mr-2">
                        Chuyển khoản ngân hàng
                    </label>
                    <p class="text-sm text-gray-600">Thực hiện thanh toán vào tài khoản ngân hàng...</p>
                    <label class="flex items-center mt-4 mb-4">
                        <input type="radio" name="payment" class="mr-2">
                        Thanh toán khi nhận hàng
                    </label>
                </div>
                
                <x-product.product-button variant="primary" class="w-full">
                    ĐẶT HÀNG
                </x-product.product-button>
                <p class="text-sm text-gray-600 mt-4">Chúng tôi cam kết bảo mật tuyệt đối thông tin cá nhân của Quý khách. Cảm ơn Quý khách đã tin tưởng chúng tôi.</p>
                </div>
                
            </div>
        </div>
    </div>

    @include('components.global.footer')
</body>
</html>