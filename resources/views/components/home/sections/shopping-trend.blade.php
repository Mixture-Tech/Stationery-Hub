<!-- Shopping Trends Section -->
<div class="w-4/5 mx-auto bg-mint py-6 rounded-lg">
    <div class="container mx-auto px-4 lg:px-8">
        <!-- Section Header -->
        <div class="flex items-center mb-4">
            <div class="bg-light-blue p-2 rounded mr-2">
                <x-icon name="home" />
            </div>
            <h2 class="text-2xl font-bold text-black">Xu Hướng Mua Sắm</h2>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200 mb-4">
            <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                    <a href="#" class="inline-block py-2 px-4 text-dark-blue border-b-2 border-dark-blue font-medium">Xu Hướng Theo Ngày</a>
                </li>
                <li class="mr-2">
                    <a href="#" class="inline-block py-2 px-4 text-gray-600 hover:text-dark-blue font-medium">Sách HOT - Giảm Sốc</a>
                </li>
                <li>
                    <a href="#" class="inline-block py-2 px-4 text-gray-600 hover:text-dark-blue font-medium">Bestseller Ngoại Văn</a>
                </li>
            </ul>
        </div>

        <!-- Product Grid - First Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="3"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="Cùng Con Trưởng Thành Qua Những Bộ Phim Thiếu Nhi Kinh Điển"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="5"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="Truyện Kể Từ Đại Dương - Lòng Tốt Nơi Biển Cả Lạnh Giá"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="5"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="Trường Học Danh Nhân Thế Giới - Tập 7: Danh Nhân Ảnh Hưởng Tới Hậu Thế (Tái Bản)"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />

            <x-product.product-card
                image="{{ ('resources/images/products/product_4.jpg') }}"
                name="A Little Life"
                :price="306900"
                :originalPrice="341000"
                :discountPercent="10"
                :rating="1"
                :soldCount="306" />
        </div>

        <!-- View More Button -->
        <div class="text-center mt-6">
            <a href="#" class="inline-block border border-light-blue text-black hover:bg-light-blue transition-colors duration-300 rounded-full px-8 py-2 font-medium">Xem Thêm</a>
        </div>
    </div>
</div>