@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Cập nhật đơn hàng</h2>
    <form action="{{ route('admin.updateOrder', $order->id_order) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-bold mb-2">Trạng thái đơn hàng</label>
        <select name="status" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
            <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Chờ xử lý</option>
            <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Đang xử lý</option>
            <option value="Complete" {{ $order->status == 'Complete' ? 'selected' : '' }}>Hoàn thành</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block font-bold mb-2">Ẩn đơn hàng</label>
        <select name="hide" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
            <option value="0" {{ $order->hide == 0 ? 'selected' : '' }}>Hiển thị</option>
            <option value="1" {{ $order->hide == 1 ? 'selected' : '' }}>Ẩn</option>
        </select>
    </div>

    <div class="flex items-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
            Cập nhật
        </button>
        <a href="{{ route('admin.orders') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all ml-2">
            Hủy
        </a>
    </div>
</form>

@endsection