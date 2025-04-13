{{-- resources/views/components/product-card.blade.php --}}

@props([
'image' => '',
'name' => '',
'price' => 0,
'discountPrice' => 0,
'discountPercent' => 0,
'rating' => 1,
'soldCount' => 0,
'id' => 0
])

<div class="bg-white rounded shadow-sm overflow-hidden hover:drop-shadow-xl">
    <a href="{{ route('products.detail', $id) }}" class="block">
        <div class="relative cursor-pointer">
            <img src="{{ $image }}" class="w-full h-52">
        </div>
        <div class="p-3">
            <h3 class="text-sm font-medium h-10 overflow-hidden line-clamp-2">{{ $name }}</h3>
            <div class="flex flex-row items-center mt-2">
                <span class="text-navy font-bold">{{ number_format($discountPrice, 3, ',', '.') }} đ</span>
                @if($discountPercent > 0)
                <span class="mr-auto bg-navy text-white text-xs px-1.5 py-0.5 rounded ml-2">-{{ $discountPercent }}%</span>
                @endif
            </div>
            <div class="flex items-center">
                @if($discountPrice > 0)
                <span class="text-gray-500 line-through text-xs">{{ number_format($price, 3, ',', '.') }} đ</span>
                @endif
            </div>
            <div class="flex items-center mt-1">
                <div class="flex text-yellow-400">
                    @for($i = 0; $i < $rating; $i++)
                        <x-icon name="star" />
                    @endfor
                </div>
                <span class="text-gray-400">|</span>
                <span class="text-sm ms-0.5 text-gray-500">Đã bán {{ $soldCount }}</span>
            </div>
        </div>
    </a>
    
    <!-- Thêm 2 nút Mua ngay và Thêm vào giỏ hàng -->
    <div class="p-3 border-t border-gray-100">
        <div class="flex space-x-2">
            <form action="{{ route('payment.direct') }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="id_product" value="{{ $id }}">
                <input type="hidden" name="quantity" value="1">
                <x-product.product-button variant="primary" type="submit" class="w-full">
                    <i class="fas fa-bolt"></i>
                </x-product.product-button>
            </form>
            <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="id_product" value="{{ $id }}">
                <input type="hidden" name="quantity" value="1">
                <x-product.product-button variant="secondary" type="submit" class="w-full">
                    <i class="fas fa-shopping-cart"></i>
                </x-product.product-button>
            </form>
        </div>
    </div>
</div>