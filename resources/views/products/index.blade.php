<x-app-layout>
    {{-- resources/views/components/product-section.blade.php --}}

    <section class="container w-4/5 mx-auto py-6 px-4">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Left sidebar - Categories and Filters -->
            <div class="w-full md:w-1/4 lg:w-1/5">
                <!-- Product Categories -->
                <div class="bg-white p-4 rounded shadow-sm mb-4">
                    <h2 class="font-bold text-medium-blue mb-3 uppercase">Nhóm sản phẩm</h2>


                    <div class="pl-3 space-y-2 cursor-pointer">
                        @foreach($categories as $mainCategory)
                            @if($mainCategory->parent_id === null)
                                <div class="font-medium">{{ $mainCategory->name }}</div>
                                <div class="pl-2 space-y-2">
                                    @foreach($categories->where('parent_id', $mainCategory->id_category) as $subCategory)
                                        <div class="text-sm hover:text-dark-blue">
                                            <a href="{{ route('products.index', ['category' => $subCategory->id_category]) }}">
                                                {{ $subCategory->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
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
                    @foreach($products as $product)
                        <div class="relative">
                            <x-product.product-card
                                image="{{ $product->image }}"
                                name="{{ $product->name }}"
                                price="{{ $product->price }}"
                                originalPrice="{{ $product->price*$product->discount }}"
                                discountPercent="{{ $product->discount }}"
                                rating="{{ rand(1, 5) }}"
                                soldCount="{{ $product->sold_count ?? rand(10, 100) }}" />
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </section>
</x-app-layout>