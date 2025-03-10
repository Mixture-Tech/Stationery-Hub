<x-app-layout>
    <div class="container w-4/5 mx-auto py-6 px-4">
        <!-- Breadcrumbs -->
        <div class="mb-4 text-sm">
            <a href="#" class="text-black hover:text-medium-blue">TRANG CHỦ</a>
            <span class="mx-2">›</span>
            <a href="#" class="text-black hover:text-medium-blue">SÁCH TIẾNG VIỆT</a>
            <span class="mx-2">›</span>
            <a href="#" class="text-black hover:text-medium-blue">TÂM LÝ - KỸ NĂNG SỐNG</a>
            <span class="mx-2">›</span>
            <span class="text-dark-blue">TÂM LÝ HỌC VỀ TIỀN</span>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Image Gallery -->
            <div class="w-full md:w-2/5 lg:w-1/3">
                <div class="bg-white p-4 rounded shadow-sm h-full">
                    <img src="{{ Vite::asset('resources/images/products/product_1.jpg') }}" 
                         alt="Tâm Lý Học Về Tiền" 
                         class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Product Information -->
            <div class="w-full md:w-3/5 lg:w-2/3 bg-white p-4 rounded shadow-sm h-full">
                <h1 class="text-2xl font-bold mb-2">Tâm Lý Học Về Tiền</h1>
                
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-500 mr-2">
                        <span>★★★★☆</span>
                    </div>
                    <span class="text-sm text-gray-600">(0 đánh giá)</span>
                    <span class="mx-2 text-gray-300">|</span>
                    <span class="text-sm text-gray-600">Đã bán 4</span>
                </div>

                <div class="bg-gray-100 p-4 rounded mb-4">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-navy mr-4">132.300 đ</span>
                        <span class="text-gray-500 line-through mr-4">189.000 đ</span>
                        <span class="bg-navy text-white px-2 py-1 rounded">-30%</span>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Thông tin chi tiết</h3>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="text-gray-600">Tác giả:</span>
                            <span>Morgan Housel</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Nhà cung cấp:</span>
                            <span>1980 Books</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Nhà xuất bản:</span>
                            <span>NXB Dân Trí</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Hình thức bìa:</span>
                            <span>Bìa Mềm</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Số lượng</h3>
                    <x-product.quantity-button />
                </div>

                <div class="flex space-x-4">
                    <x-product.product-button variant="secondary">
                        Thêm vào giỏ hàng
                    </x-home.product.product-button>
                    <x-product.product-button variant="primary">
                        Mua ngay
                    </x-home.product.product-button>
                </div>

                <div class="mt-4">
                    <h3 class="font-semibold mb-2">Ưu đãi liên quan</h3>
                    <div class="flex space-x-2">
                        <div class="bg-gray-100 p-2 rounded text-sm">
                            <span class="text-yellow-500">🏷️</span> Mã giảm 10k
                        </div>
                        <div class="bg-gray-100 p-2 rounded text-sm">
                            <span class="text-yellow-500">🏷️</span> Mã giảm 25k
                        </div>
                        <div class="bg-gray-100 p-2 rounded text-sm">
                            <span class="text-blue-500">💳</span> Home credit
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>