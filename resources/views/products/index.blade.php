@vite('resources/js/product/filter.js')

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
                        <div class="font-medium mb-2">
                            <a href="{{ route('products.index') }}" 
                            class="{{ !request('category') && !request('parent_category') ? 'text-dark-blue font-bold' : '' }}">
                                Tất cả sản phẩm
                            </a>
                        </div>
                        @foreach($categoryParents as $parent)
                            <div class="font-medium">
                                <a href="{{ route('products.index', ['parent_category' => $parent->id_parent]) }}" 
                                    class="{{ request('parent_category') == $parent->id_parent ? 'text-dark-blue font-bold' : '' }}">
                                    {{ $parent->name_parent }}
                                </a>
                            </div>
                            
                            <!-- Hiển thị danh mục con nếu danh mục cha được chọn hoặc nếu có JavaScript mở rộng -->
                            <div class="pl-2 space-y-2 {{ request('parent_category') == $parent->id_parent ? 'block' : 'hidden' }}" 
                                id="subcategories-{{ $parent->id_parent }}">
                                @foreach($categories->where('id_parent', $parent->id_parent) as $category)
                                    <div class="text-sm hover:text-dark-blue">
                                        <a href="{{ route('products.index', ['category' => $category->id_category]) }}"
                                        class="{{ request('category') == $category->id_category ? 'text-dark-blue font-bold' : '' }}">
                                            {{ $category->name_category }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="bg-white p-4 rounded shadow-sm">
                    <h2 class="font-bold text-medium-blue mb-3 uppercase">Giá</h2>
                    <form action="{{ route('products.index') }}" method="GET" id="price-filter-form">
                        @if(request()->has('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request()->has('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}">
                        @endif
                        @if(request()->has('per_page'))
                            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
                        @endif
                        
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input type="checkbox" id="price-1" name="price" value="0-150" class="mr-2 price-checkbox"
                                    {{ request('price') == '0-150' ? 'checked' : '' }}>
                                <label for="price-1" class="text-sm">0đ - 150,000đ</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="price-2" name="price" value="150-300" class="mr-2 price-checkbox"
                                    {{ request('price') == '150-300' ? 'checked' : '' }}>
                                <label for="price-2" class="text-sm">150,000đ - 300,000đ</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="price-3" name="price" value="300-500" class="mr-2 price-checkbox"
                                    {{ request('price') == '300-500' ? 'checked' : '' }}>
                                <label for="price-3" class="text-sm">300,000đ - 500,000đ</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="price-4" name="price" value="500-700" class="mr-2 price-checkbox"
                                    {{ request('price') == '500-700' ? 'checked' : '' }}>
                                <label for="price-4" class="text-sm">500,000đ - 700,000đ</label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="price-5" name="price" value="700-up" class="mr-2 price-checkbox"
                                    {{ request('price') == '700-up' ? 'checked' : '' }}>
                                <label for="price-5" class="text-sm">700,000đ - Trở Lên</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right side - Products display -->
            <div class="w-full md:w-3/4 lg:w-4/5">
                <!-- Breadcrumbs -->
                <div class="mb-4 text-sm">
                    <a href="#" class="text-black hover:text-medium-blue">TRANG CHỦ</a>
                    <span class="mx-2">›</span>
                    <span class="text-dark-blue">THIẾU NHI</span>
                </div>

                <!-- Sorting and display options -->
                <div class="flex flex-col sm:flex-row items-center mb-4">
                    <div class="flex items-center mb-2 me-3 sm:mb-0">
                        <span class="mr-2">Sắp xếp theo:</span>
                        <div class="relative flex">
                            <select id="sort-select" class="form-select appearance-none block w-full px-3 py-1.5 text-sm font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
                                <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Giá: Thấp đến cao</option>
                                <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Giá: Cao đến thấp</option>
                            </select>
                        </div>
                    </div>

                    <div class="relative">
                        <select id="per-page-select" class="form-select text-sm appearance-none block w-full px-3 py-1.5 font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            <option value="24" {{ request('per_page', 24) == 24 ? 'selected' : '' }}>24 sản phẩm</option>
                            <option value="36" {{ request('per_page') == 36 ? 'selected' : '' }}>36 sản phẩm</option>
                            <option value="48" {{ request('per_page') == 48 ? 'selected' : '' }}>48 sản phẩm</option>
                        </select>
                    </div>
                </div>

                <!-- Products grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products as $product)
                        <div class="relative">
                            <x-product.product-card
                                id="{{ $product->id_product }}"
                                image="{{ $product->image }}"
                                name="{{ $product->name }}"
                                price="{{ $product->price }}"
                                discountPrice="{{ $product->discount_price }}"
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