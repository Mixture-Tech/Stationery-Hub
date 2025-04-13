<x-app-layout>
    <div class="container w-4/5 mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow-md">

        <div class="flex flex-col">
                <!-- Phần Địa chỉ giao hàng -->
                <div class="w-full p-4">
                    <h2 class="font-bold mb-2">ĐỊA CHỈ GIAO HÀNG</h2>
                    <form action="{{ route('payment.process') }}" method="POST" id="checkout-form">
                        @csrf
                        <div class="grid grid-cols-1 gap-1 mt-4">
                            <!-- Họ và tên -->
                            <div>
                                <x-input-label for="name" :value="__('Họ và tên người nhận *')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="Nhập họ và tên người nhận" required />
                            </div>
                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email *')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="Nhập email" required />
                            </div>
                            <!-- Số điện thoại -->
                            <div>
                                <x-input-label for="phone" :value="__('Số điện thoại *')" />
                                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" placeholder="Ví dụ: 0979123xxx (10 ký tự số)" required />
                            </div>
                            <!-- Tỉnh/Thành phố -->
                            <div>
                                <x-input-label for="province" :value="__('Tỉnh/Thành phố *')" />
                                <select id="province" name="id_province" class="w-full mt-1 p-2 border rounded" required>
                                    <option value="">Chọn tỉnh/thành phố</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province->id_province }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Quận/Huyện -->
                            <div>
                                <x-input-label for="district" :value="__('Quận/Huyện *')" />
                                <select id="district" name="id_district" class="w-full mt-1 p-2 border rounded" required>
                                    <option value="">Chọn quận/huyện</option>
                                </select>
                            </div>
                            <!-- Địa chỉ nhận hàng -->
                            <div>
                                <x-input-label for="address" :value="__('Địa chỉ nhận hàng *')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" placeholder="Nhập địa chỉ nhận hàng" required />
                            </div>
                        </div>

                        <input type="hidden" name="from_cart" value="{{ $from_cart ?? false }}">

                        <!-- Phần Phương thức thanh toán -->
                        <div class="mt-6">
                            <h2 class="font-bold mb-4">PHƯƠNG THỨC THANH TOÁN</h2>
                            <label class="flex items-center mb-2">
                                <input type="radio" name="payment_methods" value="momo" class="mr-2">
                                Thanh toán qua Momo
                            </label>
                            <label class="flex items-center mb-2">
                                <input type="radio" name="payment_methods" value="vnpay" class="mr-2">
                                Thanh toán qua VNPay
                            </label>
                            <label class="flex items-center mb-2">
                                <input type="radio" name="payment_methods" value="COD" class="mr-2">
                                Thanh toán bằng tiền mặt khi nhận hàng
                            </label>
                        </div>

                        <!-- Phần Kiểm tra lại đơn hàng -->
                        <div class="mt-6">
                            <h3 class="font-bold mb-4">KIỂM TRA LẠI ĐƠN HÀNG</h3>
                            <div class="border-b pb-2 mb-2 text-sm">
                                @foreach($items as $item)
                                    <div class="flex items-center mb-2">
                                        @if($item['product'] && $item['product']->image)
                                            @if(file_exists(public_path('storage/' . $item['product']->image)))
                                                <img src="{{ asset('storage/' . $item['product']->image) }}"
                                                    alt="{{ $item['product']->name }}"
                                                    class="w-12 h-12 mr-4">
                                            @else
                                                <img src="{{ $item['product']->image }}"
                                                    alt="{{ $item['product']->name }}"
                                                    class="w-12 h-12 mr-4">
                                            @endif
                                        @else
                                            <img src="{{ asset('resources/images/default-product.jpg') }}"
                                                alt="{{ $item['product']->name ?? 'Sản phẩm' }}"
                                                class="w-12 h-12 mr-4">
                                        @endif
                                        <div class="flex-1">
                                            <p>{{ $item['product']->name }}</p>
                                        </div>
                                        <!-- <p>{{ number_format($item['total_price'], 3, '.', '.') }} đ</p> -->
                                        <p class="ml-4">{{ number_format($item['discount_price'], 3, '.', '.') }} đ</p>
                                        <p class="ml-4">x {{ $item['quantity'] }}</p>
                                        <p class="ml-4 font-bold">{{ number_format($item['total_price'], 3, '.', '.') }} đ</p>
                                    </div>
                                @endforeach
                            </div>
                            <p class="mb-2">Tạm tính <span class="float-right" id="subtotal">{{ number_format($subtotal, 3, '.', '.') }} đ</span></p>
                            <p class="mb-2">Giao hàng <span class="float-right" id="shipping-fee">0 đ</span></p>
                            <p class="font-bold text-lg">Tổng <span class="float-right" id="total">{{ number_format($subtotal, 3, '.', '.') }} đ</span></p>
                        </div>

                        <!-- Nút Xác nhận thanh toán -->
                        <div class="mt-6">
                            <x-product.product-button variant="primary" class="w-full uppercase" type="submit">
                                Xác nhận thanh toán
                            </x-product.product-button>
                        </div>

                        <!-- Hidden inputs cho items -->
                        @foreach($items as $index => $item)
                            <input type="hidden" name="items[{{$index}}][id_product]" value="{{ $item['product']->id_product }}">
                            <input type="hidden" name="items[{{$index}}][quantity]" value="{{ $item['quantity'] }}">
                            <input type="hidden" name="items[{{$index}}][total_price]" value="{{ $item['total_price'] }}">
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Dữ liệu quận/huyện từ server
    const districts = @json($districts);

    // Hàm định dạng tiền tệ
    function formatCurrency(amount) {
        amount = parseFloat(amount);
        return amount.toLocaleString('vi-VN', {
            minimumFractionDigits: 3,
            maximumFractionDigits: 3
        }).replace(/,/g, '.') + ' đ';
    }

    // Cập nhật tổng tiền
    function updateTotal(shippingFee) {
        const subtotal = parseFloat({{ $subtotal }}); // Đảm bảo là số
        shippingFee = parseFloat(shippingFee || 0); // Đảm bảo shippingFee là số
        const total = subtotal + shippingFee;
        document.getElementById('subtotal').textContent = formatCurrency(subtotal);
        document.getElementById('shipping-fee').textContent = formatCurrency(shippingFee);
        document.getElementById('total').textContent = formatCurrency(total);
    }

    // Tải quận/huyện khi chọn tỉnh/thành phố
    document.getElementById('province').addEventListener('change', function() {
        let provinceId = this.value;
        let districtSelect = document.getElementById('district');
        districtSelect.innerHTML = '<option value="">Chọn quận/huyện...</option>';

        if (provinceId) {
            const filteredDistricts = districts.filter(district => district.id_province == provinceId);
            filteredDistricts.forEach(district => {
                let option = document.createElement('option');
                option.value = district.id_district;
                option.text = district.name;
                option.setAttribute('data-fee', district.fee); // Lưu phí giao hàng
                districtSelect.appendChild(option);
            });
            updateTotal(0); // Reset shipping fee khi chưa chọn quận/huyện
        }
    });

    // Cập nhật phí giao hàng và tổng tiền khi chọn quận/huyện
    document.getElementById('district').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let shippingFee = selectedOption ? parseFloat(selectedOption.getAttribute('data-fee') || 0) : 0;
        updateTotal(shippingFee);
    });
    
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
    // Lấy dữ liệu form
    let name = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let phone = document.getElementById('phone').value.trim();
    let province = document.getElementById('province').value;
    let district = document.getElementById('district').value;
    let address = document.getElementById('address').value.trim();
    let paymentMethod = document.querySelector('input[name="payment_methods"]:checked');

    // Regex kiểm tra
    let phoneRegex = /^\d{10}$/;
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Kiểm tra từng điều kiện
    if (!name || !email || !phone || !province || !district || !address) {
        alert("Vui lòng điền đầy đủ tất cả thông tin!");
        e.preventDefault();
        return;
    }

    if (!emailRegex.test(email)) {
        alert("Email không hợp lệ. Vui lòng kiểm tra lại!");
        e.preventDefault();
        return;
    }

    if (!phoneRegex.test(phone)) {
        alert("Số điện thoại phải đúng 10 chữ số!");
        e.preventDefault();
        return;
    }

    if (!paymentMethod) {
        alert("Vui lòng chọn phương thức thanh toán!");
        e.preventDefault();
        return;
    }
});

</script>