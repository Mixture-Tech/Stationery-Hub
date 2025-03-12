@props(['items' => []])

<nav class="mb-4 text-sm" aria-label="breadcrumb">
    <ol class="flex flex-wrap items-center">
        <li class="flex items-center">
            <a href="{{ route('products.index') }}" class="text-black hover:text-medium-blue">TRANG CHỦ</a>
        </li>
        
        @foreach ($items as $index => $item)
            <li class="flex items-center">
                <span class="mx-2 text-gray-500">›</span>
                
                @if ($item['url'] ?? false)
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