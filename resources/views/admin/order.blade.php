@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Orders</h2>

    <!-- form tìm kiếm order -->
    <div class="mb-4">
        <form action="{{ route('admin.orders') }}" method="GET" class="flex items-center flex-wrap gap-2">
            <input type="text" name="search" placeholder="Tìm kiếm theo mã đơn, trạng thái, hoặc người đặt..." 
                value="{{ request('search') }}" 
                class="border border-gray-300 rounded-lg px-4 py-2 w-1/3 min-w-[200px]">
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                🔍 Tìm kiếm
            </button>

            @if(request('search'))
                <a href="{{ route('admin.orders') }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition inline-flex items-center">
                    Xóa tìm kiếm
                </a>
            @endif
        </form>
    </div>

    @if($orders->isEmpty())
        @if(request('search'))
            <p class="text-gray-500">Không tìm thấy đơn hàng nào khớp với từ khóa "{{ request('search') }}".</p>
        @else
            <p class="text-gray-500">Không có đơn hàng nào để hiển thị.</p>
        @endif
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md border border-gray-300">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border border-gray-300 px-4 py-2">ID</th>
                        <th class="border border-gray-300 px-4 py-2">Người Đặt</th>
                        <th class="border border-gray-300 px-4 py-2">Tỉnh</th>
                        <th class="border border-gray-300 px-4 py-2">Huyện</th>
                        <th class="border border-gray-300 px-4 py-2">Khu Vực</th>
                        <th class="border border-gray-300 px-4 py-2">Tổng Tiền</th>
                        <th class="border border-gray-300 px-4 py-2">Trạng Thái Xử Lý</th>
                        <th class="border border-gray-300 px-4 py-2">Phương Thức Thanh Toán</th>
                        <th class="border border-gray-300 px-4 py-2">Ngày Tạo</th>
                        <th class="border border-gray-300 px-4 py-2">Ngày Cập Nhật</th>
                        <th class="border border-gray-300 px-4 py-2">Trạng Thái</th>
                        <th class="border border-gray-300 px-4 py-2">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->id_order }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ optional($order->user)->name ?? 'Không xác định' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ optional($order->province)->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ optional($order->district)->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ optional($order->area)->name ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ number_format($order->total_price, 2, ',', '.') }} VNĐ</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <span class="px-2 py-1 rounded 
                                    {{ $order->status == 'Pending' ? 'bg-yellow-500 text-white' : 
                                    ($order->status == 'Processing' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white') }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->payment_methods }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $order->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="border bordor-gray-300 py-3 px-4 text-center">
                                    @if($order->hide == 0)
                                        <span class="text-green-600 font-semibold">Hiển thị</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Ẩn</span>
                                    @endif
                                </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('admin.updateOrder', $order->id_order) }}" 
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition-all">
                                        Update
                                    </a>
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
@endsection