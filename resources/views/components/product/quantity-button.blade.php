<div class="flex items-center">
    <button 
        type="button" 
        id="decrease-qty-{{ $id }}" 
        class="bg-gray-200 cursor-pointer px-3 py-1 border border-r-0 border-gray-400 rounded-l hover:bg-light-blue"
    >
        -
    </button>
    <input 
        type="number" 
        id="{{ $id }}" 
        name="{{ $name ?? 'quantity' }}" 
        value="{{ $value ?? 1 }}" 
        min="1" 
        max="{{ $max ?? 100 }}" 
        class="w-12 text-center border-t border-b border-gray-400 py-1 focus:outline-none 
            appearance-none 
            [-moz-appearance:_textfield] 
            [&::-webkit-outer-spin-button]:m-0 
            [&::-webkit-outer-spin-button]:appearance-none 
            [&::-webkit-inner-spin-button]:m-0 
            [&::-webkit-inner-spin-button]:appearance-none"
    >
    <button 
        type="button" 
        id="increase-qty-{{ $id }}" 
        class="bg-gray-200 cursor-pointer px-3 py-1 border border-l-0 border-gray-400 rounded-r hover:bg-light-blue"
    >
        +
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.getElementById('decrease-qty-{{ $id }}');
    const increaseBtn = document.getElementById('increase-qty-{{ $id }}');
    const quantityInput = document.getElementById('{{ $id }}');

    decreaseBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn reload trang
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > parseInt(quantityInput.min)) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn reload trang
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < parseInt(quantityInput.max)) {
            quantityInput.value = currentValue + 1;
        }
    });
});
</script>