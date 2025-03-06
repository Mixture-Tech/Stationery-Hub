<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Hub</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-soft-gray">
    @include('components.global.navbar')

    {{-- resources/views/components/product-section.blade.php --}}

    <section class="container w-4/5 mx-auto py-6 px-4">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left sidebar - Categories and Filters -->
            <div class="w-full md:w-1/4 lg:w-1/5">
                <!-- Product Categories -->
                <div class="bg-white p-4 rounded shadow-sm mb-4">
                    <h2 class="font-bold text-medium-blue mb-3 uppercase">Nhóm sản phẩm</h2>


                    <div class="pl-3 space-y-2 cursor-pointer">
                        <div class="font-medium">Sách Tiếng Việt</div>
                        <div class="pl-2 space-y-2 ">
                            <div class="text-sm hover:text-dark-blue">Thiếu nhi</div>
                            <div class="text-sm hover:text-dark-blue">Thanh niên</div>
                            <div class="text-sm hover:text-dark-blue">Người già</div>
                        </div>
                        <div class="font-medium">Sách Toán</div>
                        <div class="pl-2 space-y-2 ">
                            <div class="text-sm hover:text-dark-blue">Thiếu nhi</div>
                            <div class="text-sm hover:text-dark-blue">Thanh niên</div>
                            <div class="text-sm hover:text-dark-blue">Người già</div>
                        </div>
                        <div class="font-medium">Sách Tiếng Anh</div>
                        <div class="pl-2 space-y-2 ">
                            <div class="text-sm hover:text-dark-blue">Thiếu nhi</div>
                            <div class="text-sm hover:text-dark-blue">Thanh niên</div>
                            <div class="text-sm hover:text-dark-blue">Người già</div>
                        </div>
                        <div class="font-medium">Sách Ngữ Văn</div>
                        <div class="pl-2 space-y-2 ">
                            <div class="text-sm hover:text-dark-blue">Thiếu nhi</div>
                            <div class="text-sm hover:text-dark-blue">Thanh niên</div>
                            <div class="text-sm hover:text-dark-blue">Người già</div>
                        </div>
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="bg-white p-4 rounded shadow-sm">
                    <h2 class="font-bold text-medium-blue mb-3 uppercase">Giá</h2>

                    <div class="space-y-2">
                        <div class="flex items-center">
                            <input type="checkbox" id="price-1" class="mr-2">
                            <label for="price-1" class="text-sm">0đ - 150,000đ</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="price-2" class="mr-2">
                            <label for="price-2" class="text-sm">150,000đ - 300,000đ</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="price-3" class="mr-2">
                            <label for="price-3" class="text-sm">300,000đ - 500,000đ</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="price-4" class="mr-2">
                            <label for="price-4" class="text-sm">500,000đ - 700,000đ</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="price-5" class="mr-2">
                            <label for="price-5" class="text-sm">700,000đ - Trở Lên</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side - Products display -->
            <div class="w-full md:w-3/4 lg:w-4/5">
                <!-- Breadcrumbs -->
                <div class="mb-4 text-sm">
                    <a href="#" class="text-black hover:text-medium-blue">TRANG CHỦ</a>
                    <span class="mx-2">›</span>
                    <a href="#" class="text-black hover:text-medium-blue">SÁCH TIẾNG VIỆT</a>
                    <span class="mx-2">›</span>
                    <span class="text-dark-blue">THIẾU NHI</span>
                </div>

                <!-- Sorting and display options -->
                <div class="flex flex-col sm:flex-row items-center mb-4">
                    <div class="flex items-center mb-2 me-3 sm:mb-0">
                        <span class="mr-2">Sắp xếp theo:</span>
                        <div class="relative flex ">
                            <select class="form-select appearance-none block w-full px-3 py-1.5 text-sm font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option selected>Mới nhất</option>
                                <option value="1">Giá: Thấp đến cao</option>
                                <option value="2">Giá: Cao đến thấp</option>
                                <option value="3">Bán chạy nhất</option>
                            </select>
                        </div>
                    </div>

                    <div class="relative">
                        <select class="form-select text-sm appearance-none block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option selected>24 sản phẩm</option>
                            <option value="1">36 sản phẩm</option>
                            <option value="2">48 sản phẩm</option>
                        </select>
                    </div>
                </div>

                <!-- Products grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    <!-- Example product 1 -->
                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_1.jpg') }}"
                            name="Công Chúa Nhỏ - A Little Princess - Song Ngữ Việt-Anh"
                            price="89100"
                            originalPrice="99000"
                            discountPercent="10"
                            rating="4"
                            soldCount="120" />
                    </div>

                    <!-- Example product 2 -->
                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_2.jpg') }}"
                            name="Tiệm Bánh Mì Của Iston"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="5"
                            soldCount="85" />
                    </div>

                    <!-- Example product 3 -->
                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_3.jpg') }}"
                            name="Iston Và Buổi Hòa Nhạc"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="4"
                            soldCount="62" />
                    </div>

                    <!-- Example product 4 -->
                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_4.jpg') }}"
                            name="Iston Và Cơn Gió Đầu Xuân"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="5"
                            soldCount="74" />
                    </div>

                    <!-- Add more products as needed -->
                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_4.jpg') }}"
                            name="Cùng Trẻ Lớn Lên - Rèn Luyện Lòng Dũng Cảm"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="4"
                            soldCount="59" />
                    </div>

                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_3.jpg') }}"
                            name="Cùng Trẻ Lớn Lên - Rèn Luyện Tính Tự Giác"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="4"
                            soldCount="47" />
                    </div>

                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_1.jpg') }}"
                            name="Cùng Trẻ Lớn Lên - Nâng Lương Tích Cực"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="5"
                            soldCount="82" />
                    </div>

                    <div class="relative">
                        <x-product.product-card
                            image="{{ ('resources/images/products/product_2.jpg') }}"
                            name="Cùng Trẻ Lớn Lên - Không Dựa Dẫm"
                            price="34200"
                            originalPrice="38000"
                            discountPercent="10"
                            rating="4"
                            soldCount="53" />
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    <nav class="inline-flex rounded-md shadow-sm">
                        <a href="#" class="px-3 py-1 rounded-l-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                            «
                        </a>
                        <a href="#" class="px-3 py-1 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                            1
                        </a>
                        <a href="#" class="px-3 py-1 border border-gray-300 bg-dark-blue text-white">
                            2
                        </a>
                        <a href="#" class="px-3 py-1 border-t border-b border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                            3
                        </a>
                        <a href="#" class="px-3 py-1 rounded-r-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50">
                            »
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    @include('components.global.footer')
</body>

</html>