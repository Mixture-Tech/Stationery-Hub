{{-- resources/views/orders/index.blade.php --}}
<x-app-layout>
    <section class="container w-4/5 mx-auto py-6 px-4">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-dark-blue mb-6">Đơn hàng của tôi</h1>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($orders->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Bạn chưa có đơn hàng nào.</p>
                    <a href="{{ route('products.index') }}" class="bg-medium-blue text-white px-4 py-2 rounded hover:bg-dark-blue">
                        Mua sắm ngay
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left">Ngày đặt</th>
                                <th class="py-3 px-4 text-left">Thời gian đặt</th>
                                <th class="py-3 px-4 text-left">Tổng tiền</th>
                                <th class="py-3 px-4 text-left">Phương thức thanh toán</th>
                                <th class="py-3 px-4 text-left">Trạng thái</th>
                                <th class="py-3 px-4 text-left">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4">{{ $order->created_at->format('d/m/Y') }}</td>
                                    <td class="py-3 px-4">{{ $order->created_at->format('H:i') }}</td>
                                    <td class="py-3 px-4">
                                    @if($order->payment_methods == 'momo')
                                        {{ number_format($order->total_price, 0, '.', '.') }} đ
                                    @else
                                        {{ number_format($order->total_price, 3, ',', '.') }} đ
                                    @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        @if($order->payment_methods == 'cod')
                                            Thanh toán khi nhận hàng
                                        @elseif($order->payment_methods == 'momo')
                                            Thanh toán qua Momo
                                        @elseif($order->payment_methods == 'vnpay')
                                            Thanh toán qua VNPay
                                        @else
                                            {{ $order->payment_methods }}
                                        @endif
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded text-white text-sm
                                            @if($order->status == 'Pending') bg-yellow-600
                                            @elseif($order->status == 'Confirmed') bg-purple-500
                                            @elseif($order->status == 'Processing') bg-blue-500
                                            @elseif($order->status == 'Shipped') bg-purple-500
                                            @elseif($order->status == 'Complete') bg-green-500
                                            @elseif($order->status == 'Cancelled') bg-red-500
                                            @endif">
                                            @if($order->status == 'Pending') Chờ xác nhận
                                            @elseif($order->status == 'Confirmed') Xác nhận
                                            @elseif($order->status == 'Processing') Đang xử lý
                                            @elseif($order->status == 'Shipped') Đang giao
                                            @elseif($order->status == 'Complete') Đã giao
                                            @elseif($order->status == 'Cancelled') Đã hủy
                                            @else {{ $order->status }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('orders.detail', $order->id_order) }}" class="text-blue-500 hover:underline">
                                                Xem
                                            </a>
                                            
                                            @if($order->status == 'pending')
                                                <form action="{{ route('orders.cancel', $order->id_order) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-red-500 hover:underline">
                                                        Hủy
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <form action="{{ route('orders.hide', $order->id_order) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn ẩn đơn hàng này khỏi danh sách?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-gray-500 hover:underline">
                                                    Ẩn
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
