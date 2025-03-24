@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Thêm danh mục mới</h2>
    <form action="{{ route('admin.addCategoryPost') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block font-bold mb-2">Tên danh mục</label>
            <input type="text" name="name_category" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label for="id_parent" class="block font-bold mb-2">Danh mục cha</label>
            <select name="id_parent" class="w-full border border-gray-300 rounded px-4 py-2" required>
                <option value="">-- Chọn danh mục cha --</option>
                @foreach ($categoryparents as $categoryparent)
                    <option value="{{ $categoryparent->id_parent }}">{{ $categoryparent->name_parent }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Trạng thái</label>
            <select name="hide" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
                <option value="0">Hiển thị</option>
                <option value="1">Ẩn</option>
            </select>
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-all">
                Thêm mới
            </button>
            <a href="{{ route('admin.categories') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 hover:bg-gray-600 transition-all">
                Hủy
            </a>
        </div>
    </form>
@endsection
