@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Cập Nhật Tài Khoản Người Dùng</h2>
    <form action="{{ route('admin.updateUser', $user->id_user) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-bold mb-2">Chức vụ</label>
        <select name="id_role" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
            <option value="3" {{ $user->id_role == '3' ? 'selected' : '' }}>USER</option>
            <option value="2" {{ $user->id_role == '2' ? 'selected' : '' }}>EMPLOYEE</option>
            <option value="1" {{ $user->id_role == '1' ? 'selected' : '' }}>ADMIN</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block font-bold mb-2">Ẩn đơn hàng</label>
        <select name="hide" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
            <option value="0" {{ $user->hide == 0 ? 'selected' : '' }}>Hiển thị</option>
            <option value="1" {{ $user->hide == 1 ? 'selected' : '' }}>Ẩn</option>
        </select>
    </div>

    <div class="flex items-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
            Cập nhật
        </button>
        <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all ml-2">
            Hủy
        </a>
    </div>
</form>

@endsection