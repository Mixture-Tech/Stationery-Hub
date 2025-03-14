@props(['items' => []])

<nav class="mb-4 text-sm" aria-label="breadcrumb">
    <ol class="flex flex-wrap items-center">
        {{-- Trang chủ luôn là phần tử đầu tiên --}}
        <li class="flex items-center">
            <a href="{{ route('dashboard') }}" class="text-black hover:text-medium-blue uppercase">
                TRANG CHỦ
            </a>
        </li>
        
        {{-- Các phần tử breadcrumb khác --}}
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                <span class="mx-2 text-gray-500">›</span>
                @if (isset($item['url']))
                    <a href="{{ $item['url'] }}" class="text-black hover:text-medium-blue uppercase">
                        {{ $item['name'] }}
                    </a>
                @else
                    <span class="text-dark-blue uppercase">{{ $item['name'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>