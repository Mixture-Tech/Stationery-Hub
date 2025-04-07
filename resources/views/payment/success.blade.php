<x-app-layout>
    <div class="container max-w-2xl mx-auto py-8 px-4">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <!-- Header Section -->
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-green-600">ĐẶT HÀNG THÀNH CÔNG!</h2>
                <p class="text-gray-600 mt-2 max-w-md mx-auto">Cảm ơn bạn đã mua sắm tại Stationery Hub. Đơn hàng của bạn sẽ được xử lý và giao trong thời gian sớm nhất.</p>
            </div>

            <!-- Order Details Section -->
            <div class="mt-6 bg-gray-50 p-6 rounded-lg border border-gray-200 mb-6">
                <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-800">Chi Tiết Đơn Hàng</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-500 text-sm">Mã đơn hàng</p>
                        <p class="font-semibold text-gray-800">#{{ $order->id_order }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Tên người đặt</p>
                        <p class="font-semibold text-gray-800">{{ $customer_info['name'] ?? Auth::user()->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Số điện thoại</p>
                        <p class="font-semibold text-gray-800">{{ $customer_info['phone'] ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Phương thức thanh toán</p>
                        <p class="font-semibold text-gray-800">{{ $order->payment_methods == 'COD' ? 'Thanh toán khi nhận hàng' : 'Chuyển khoản ngân hàng' }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <p class="text-gray-500 text-sm">Địa chỉ giao hàng</p>
                    <p class="font-semibold text-gray-800">{{ $customer_info['address'] ?? '' }}, {{ $order->district->name }}, {{ $order->province->name }}</p>
                </div>

                <div class="mt-6 pt-4 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <p class="text-lg font-medium text-gray-600">Tổng tiền:</p>
                        <p class="text-xl font-bold text-green-600">
                            @if($order->payment_methods == 'momo')
                                {{ number_format($order->total_price, 0, '.', '.') }} đ
                            @else
                                {{ number_format($order->total_price, 3, '.', '.') }} đ
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <a href="{{ route('products.index') }}" class="block">
                <x-product.product-button variant="primary" class="w-full py-3 text-center font-medium">
                    Tiếp tục mua sắm
                </x-product.product-button>
            </a>

            <!-- Additional Links (Optional) -->
            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-gray-500 hover:text-green-600 mr-4">Theo dõi đơn hàng</a>
                <a href="#" class="text-sm text-gray-500 hover:text-green-600">Liên hệ hỗ trợ</a>
            </div>
        </div>
    </div>
</x-app-layout>