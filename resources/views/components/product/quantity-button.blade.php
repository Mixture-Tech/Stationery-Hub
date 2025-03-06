<!-- resources/views/components/product/quantity-button.blade.php -->
<div class="flex items-center">
    <button 
        id="decrease-qty" 
        class="bg-gray-200 cursor-pointer px-3 py-1 border border-r-0 border-gray-400 rounded-l hover:bg-light-blue"
    >
        -
    </button>
    <input 
        type="number" 
        id="quantity" 
        value="1" 
        min="1" 
        class="w-12 text-center border-t border-b border-gray-400 py-1 focus:outline-none 
            appearance-none 
            [-moz-appearance:_textfield] 
            [&::-webkit-outer-spin-button]:m-0 
            [&::-webkit-outer-spin-button]:appearance-none 
            [&::-webkit-inner-spin-button]:m-0 
            [&::-webkit-inner-spin-button]:appearance-none"
    >
    <button 
        id="increase-qty" 
        class="bg-gray-200 cursor-pointer px-3 py-1 border border-l-0 border-gray-400 rounded-r hover:bg-light-blue"
    >
        +
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const decreaseBtn = document.getElementById('decrease-qty');
    const increaseBtn = document.getElementById('increase-qty');
    const quantityInput = document.getElementById('quantity');

    decreaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
        }
    });

    increaseBtn.addEventListener('click', function() {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });
});
</script>