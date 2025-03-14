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
                <span class="text-navy font-bold">{{ number_format($price, 3, ',', '.') }} đ</span>
                @if($discountPercent > 0)
                <span class="mr-auto bg-navy text-white text-xs px-1.5 py-0.5 rounded ml-2">-{{ $discountPercent }}%</span>
                @endif
            </div>
            <div class="flex items-center">
                @if($discountPrice > 0)
                <span class="text-gray-500 line-through text-xs">{{ number_format($discountPrice, 3, ',', '.') }} đ</span>
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
</div>