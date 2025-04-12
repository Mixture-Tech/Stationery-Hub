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
                            <!-- Giữ trạng thái checkbox từ session nếu có -->
                            <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" class="mr-4 cart-item-checkbox"
                                data-price="{{ $item->total_price }}"
                                {{ in_array($item->id, session('selected_cart_ids', [])) ? 'checked' : '' }}>
                            @if($item->product && $item->product->image)
                                @if(file_exists(public_path('storage/' . $item->product->image)))
                                    <img src="{{ asset('storage/' . $item->product->image) }}"
                                         alt="{{ $item->product->name }}"
                                         class="w-20 h-20 object-cover mr-4">
                                @else
                                    <img src="{{ $item->product->image }}"
                                         alt="{{ $item->product->name }}"
                                         class="w-20 h-20 object-cover mr-4">
                                @endif
                            @else
                                <img src="{{ asset('resources/images/default-product.jpg') }}"
                                     alt="{{ $item->product->name ?? 'Sản phẩm' }}"
                                     class="w-20 h-20 object-cover mr-4">
                            @endif
                            <div class="flex-grow">
                                <p class="font-medium">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">{{ number_format($item->product->discount_price, 3, '.', '.') }} đ</p>
                            </div>
                            <x-product.quantity-button
                                :id="'quantity-' . $item->id"
                                :name="'quantities[' . $item->id . ']'"
                                :value="$item->quantity"
                                :max="$item->product->nums" />
                            <div class="font-medium w-24 text-right ms-4">{{ number_format($item->total_price, 3, '.', '.') }} đ</div>
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
                            <span>Thành tiền</span>
                            <span id="subtotal">0 đ</span>
                        </div>
                        <!-- <div class="flex justify-between text-sm text-gray-600">
                            <span>Giao hàng</span>
                            <span id="shipping-fee">{{ number_format(35000, 3, '.', '.') }} đ</span>
                        </div> -->
                    </div>
                    <div class="border-t-2 border-gray-200 pt-2 mb-4">
                        <div class="flex justify-between font-bold">
                            <span>Tổng</span>
                            <span class="text-navy" id="total">0 đ</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">(Đã bao gồm VAT nếu có)</p>
                    </div>
                    <form action="{{ route('payment.cart') }}" method="POST" id="checkout-cart-form">
                        @csrf
                        @foreach($cartItems as $item)
                        <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}" class="hidden cart-checkbox" data-price="{{ $item->total_price }}">
                        @endforeach
                        <x-product.product-button variant="primary" class="w-full" type="submit">
                            Tiến hành thanh toán
                        </x-product.product-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Hàm định dạng tiền tệ
    function formatCurrency(amount) {
        amount = parseFloat(amount);
        return amount.toLocaleString('vi-VN', {
            minimumFractionDigits: 3,
            maximumFractionDigits: 3
        }).replace(/,/g, '.') + ' đ';
    }

    // Tính toán tổng tiền
    function updateSummary() {
        let selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
        let subtotal = 0;
        selectedItems.forEach(item => {
            let price = parseFloat(item.getAttribute('data-price'));
            if (!isNaN(price)) {
                subtotal += price;
            }
        });

        document.getElementById('subtotal').textContent = formatCurrency(subtotal);
        document.getElementById('total').textContent = formatCurrency(subtotal);

        // Cập nhật hidden checkboxes cho form thanh toán
        let hiddenCheckboxes = document.querySelectorAll('.cart-checkbox');
        hiddenCheckboxes.forEach(hidden => {
            hidden.checked = false;
            selectedItems.forEach(selected => {
                if (hidden.value === selected.value) {
                    hidden.checked = true;
                }
            });
        });
    }

    // Xử lý sự kiện khi checkbox thay đổi
    document.querySelectorAll('.cart-item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSummary();
            // Lưu trạng thái checkbox vào session bằng AJAX (tùy chọn)
        });
    });

    // Xử lý checkbox "Chọn tất cả"
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.cart-item-checkbox');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        updateSummary();
    });

    // Xử lý xóa các sản phẩm đã chọn
    function deleteSelected() {
        let selected = Array.from(document.querySelectorAll('.cart-item-checkbox:checked'))
            .map(checkbox => checkbox.value);

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

    // Khởi tạo tổng tiền ban đầu dựa trên trạng thái checkbox
    window.addEventListener('load', function() {
        updateSummary(); // Gọi hàm này sau khi trang tải để đồng bộ tổng tiền
    });

    // Cập nhật logic khi submit form thanh toán
    document.getElementById('checkout-cart-form').addEventListener('submit', function(e) {
        const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');

        // Cập nhật hidden checkboxes trước khi submit
        let hiddenCheckboxes = document.querySelectorAll('.cart-checkbox');
        hiddenCheckboxes.forEach(hidden => {
            hidden.checked = false;
        });

        selectedItems.forEach(item => {
            const value = item.value;
            document.querySelector(`.cart-checkbox[value="${value}"]`).checked = true;
        });
    });
</script>