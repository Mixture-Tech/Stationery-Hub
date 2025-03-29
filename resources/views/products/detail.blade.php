<x-app-layout>
    <div class="container w-4/5 mx-auto py-6 px-4">
        <!-- Breadcrumbs -->
        <x-product.breadcrumb :items="$breadcrumbItems" />

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Product Image Gallery -->
            <div class="w-full md:w-2/5 lg:w-1/3">
                <div class="bg-white p-4 rounded shadow-sm h-full">
                    <img src="{{ $product->image }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Product Information -->
            <div class="w-full md:w-3/5 lg:w-2/3 bg-white p-4 rounded shadow-sm h-full">
                <h1 class="text-2xl font-bold mb-2">{{ $product->name }}</h1>

                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-500 mr-2">
                        @for($i = 0; $i < 4; $i++)
                            <span>★</span>
                            @endfor
                            <span>☆</span>
                    </div>
                    <span class="text-sm text-gray-600">(0 đánh giá)</span>
                    <span class="mx-2 text-gray-300">|</span>
                    <span class="text-sm text-gray-600">Đã bán {{ $product->sold_count ?? rand(10, 100) }}</span>
                </div>

                <div class="bg-gray-100 p-4 rounded mb-4">
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-navy mr-4">{{ number_format($product->discount_price, 3, ',', '.') }} đ</span>
                        @if($product->discount_price > 0)
                        <span class="text-gray-500 line-through mr-4">{{ number_format($product->price, 3, ',', '.') }} đ</span>
                        <span class="bg-navy text-white px-2 py-1 rounded">-{{ $product->discount }}%</span>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Thông tin chi tiết</h3>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="text-gray-600">Thương hiệu:</span>
                            <span>{{ $product->brand ?? 'Đang cập nhật' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Danh mục:</span>
                            <span>{{ $product->category->name_category }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Còn lại:</span>
                            <span>{{ $product->nums }} sản phẩm</span>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h3 class="font-semibold mb-2">Số lượng</h3>
                    <x-product.quantity-button :value="1" :max="$product->nums" :id="'quantity-product-' . $product->id_product" />
                </div>

                <!-- Trong phần nút "Thêm vào giỏ hàng" -->
                <div class="flex space-x-4">
                    <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                        <input type="hidden" name="quantity" id="quantity-hidden">
                        <x-product.product-button variant="secondary" type="submit">
                            Thêm vào giỏ hàng
                        </x-product.product-button>
                    </form>
                    <form action="{{ route('payment.direct') }}" method="POST" id="buy-now-form">
                        @csrf
                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                        <input type="hidden" name="quantity" id="quantity-hidden-buy-now">
                        <x-product.product-button variant="primary" type="submit">
                            Mua ngay
                        </x-product.product-button>
                    </form>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="my-8 bg-white p-6 rounded shadow-sm">
            <h2 class="text-xl font-bold mb-4">Mô tả sản phẩm</h2>
            <div class="prose max-w-none">
                {!! $product->description !!}
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('add-to-cart-form').addEventListener('submit', function(e) {
        const quantityInput = document.getElementById('quantity-product-{{ $product->id_product }}');
        const quantityHidden = document.getElementById('quantity-hidden');
        if (quantityInput) {
            quantityHidden.value = quantityInput.value;
        }
    });

    document.getElementById('buy-now-form').addEventListener('submit', function(e) {
        const quantityInput = document.getElementById('quantity-product-{{ $product->id_product }}');
        const quantityHidden = document.getElementById('quantity-hidden-buy-now');
        if (quantityInput) {
            quantityHidden.value = quantityInput.value;
        }
    });
</script>