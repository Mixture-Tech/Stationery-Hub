@extends('admin.admin') 

@section('content')
    <h2 class="text-2xl font-bold mb-4">Thêm danh mục mới</h2>

    {{-- Hiển thị thông báo lỗi chung (nếu có) --}}
    @if (session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.addParentPost') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block font-bold mb-2">Tên danh mục</label>
            <input type="text" name="name_parent" class="w-full border border-gray-400 rounded-lg px-4 py-2" value="{{ old('name_parent') }}" required>

            @error('name_parent')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Trạng thái</label>
            <select name="hide" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
                <option value="0" {{ old('hide') == "0" ? 'selected' : '' }}>Hiển thị</option>
                <option value="1" {{ old('hide') == "1" ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-all">
                Thêm mới
            </button>
            <a href="{{ route('admin.categoryparents') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 hover:bg-gray-600 transition-all">
                Hủy
            </a>
        </div>
    </form>
@endsection 
