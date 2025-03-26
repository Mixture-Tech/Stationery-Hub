<x-app-layout>
    <div class="container w-4/5 mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow-md">
            <div class="p-4 border-b-4 border-gray-200">
                <h1 class="text-2xl font-bold">Giỏ Hàng</h1>
            </div>

            <div class="flex flex-col md:flex-row">
                <!-- Left Column: Cart Items -->
                <div class="w-full md:w-2/3 p-4">
                    @if($cartItems->isEmpty())
                        <p class="text-gray-500">Giỏ hàng của bạn đang trống.</p>
                    @else
                        <form action="{{ route('cart.update') }}" method="POST">
                            @csrf
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="select-all" class="mr-2">
                                    <label for="select-all" class="text-sm">Chọn tất cả ({{ $cartItems->count() }} sản phẩm)</label>
                                </div>
                                <button type="button" class="text-sm text-navy" onclick="deleteSelected()">Xóa</button>
                            </div>

                            @foreach($cartItems as $item)
                                <div class="flex items-center border-b-2 border-gray-200 py-4">
                                    <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" class="mr-4">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-20 h-20 object-cover mr-4">
                                    <div class="flex-grow">
                                        <p class="font-medium">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">{{ number_format($item->product->price, 3, '.', '.') }} đ</p>
                                    </div>
                                    <!-- <input type="number" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" max="{{ $item->product->nums }}" class="w-16 border rounded p-1"> -->
                                    
                                    <x-product.quantity-button 
                                        :id="'quantity-' . $item->id" 
                                        :name="'quantities[' . $item->id . ']'" 
                                        :value="$item->quantity" 
                                        :max="$item->product->nums" 
                                    />
                                    <div class="font-medium w-24 text-right ms-4">{{ number_format($item->total_price, 3, '.', '.') }} đ</div>
                                    <!-- <button type="button" onclick="window.location.href='{{ route('cart.remove', ['cart_id' => $item->id]) }}'" class="ml-4 text-gray-400 hover:text-navy">
                                        <x-icon name="trash"/>
                                    </button> -->
                                </div>
                            @endforeach

                            <div class="flex justify-between items-center mt-4 text-sm">
                                <x-product.product-button variant="outline" onclick="window.location.href ='{{ route('products.index') }}'">
                                    Tiếp tục xem sản phẩm
                                </x-product.product-button>
                                <x-product.product-button variant="secondary" type="submit">
                                    Cập nhật giỏ hàng
                                </x-product.product-button>
                            </div>
                        </form>
                    @endif
                </div>

                <!-- Right Column: Order Summary -->
                <div class="w-full md:w-1/3 bg-gray-50 p-4 border-l-4 border-gray-200">
                    <h3 class="font-semibold mb-4">TỔNG CỘNG GIỎ HÀNG</h3>
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span>Tạm tính</span>
                            <span>{{ number_format($subtotal, 3, '.', '.') }} đ</span>
                        </div>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Giao hàng</span>
                            <span>Tùy chọn giao hàng sẽ được cập nhật</span>
                        </div>
                    </div>
                    <div class="border-t-2 border-gray-200 pt-2 mb-4">
                        <div class="flex justify-between font-bold">
                            <span>Tổng</span>
                            <span class="text-navy">{{ number_format($total, 3, '.', '.') }} đ</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">(Đã bao gồm VAT nếu có)</p>
                    </div>
                    <x-product.product-button variant="primary" class="w-full">
                        Tiến hành thanh toán
                    </x-product.product-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('input[name="cart_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    function deleteSelected() {
        let selected = Array.from(document.querySelectorAll('input[name="cart_ids[]"]:checked'))
            .map(checkbox => checkbox.value);
        
        if (selected.length === 0) {
            alert('Vui lòng chọn ít nhất một sản phẩm để xóa!');
            return;
        }

        if (confirm('Bạn có chắc muốn xóa các sản phẩm đã chọn?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("cart.remove.multiple") }}';
            
            let csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            selected.forEach(id => {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'cart_ids[]';
                input.value = id;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>