{{-- resources/views/components/button.blade.php --}}
@props([
    'type' => 'button',
    'variant' => 'primary', // primary, secondary, or outline
    'class' => ''
])

@php
    $baseClasses = 'px-6 py-2 rounded font-medium transition-colors duration-200 ';
    
    $variantClasses = [
        'primary' => 'bg-navy text-white hover:bg-mint hover:text-navy cursor-pointer',
        'secondary' => 'bg-white border border-navy text-navy hover:bg-mint cursor-pointer',
        'outline' => 'bg-transparent border border-black text-black hover:bg-black hover:text-white cursor-pointer'
    ];
    
    $classes = $baseClasses . ($variantClasses[$variant] ?? '') . ' ' . $class;
@endphp

<button {{ $attributes->merge(['type' => $type, 'class' => $classes]) }}>
    {{ $slot }}
</button>