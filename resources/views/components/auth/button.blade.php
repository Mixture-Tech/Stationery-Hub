@props(['type' => 'submit', 'text'])

<button type="{{ $type }}" class="w-full bg-medium-blue text-white py-3 rounded-lg hover:bg-dark-blue transition">
    {{ $text }}
</button>
