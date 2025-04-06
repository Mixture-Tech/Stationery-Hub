@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Cập nhật danh mục</h2>

    <form action="{{ route('admin.updatecategoryPost', $category->id_category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-bold mb-2">Tên danh mục</label>
            <input type="text" name="name_category" value="{{ $category->name_category }}" 
                class="w-full border-gray-300 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">Ẩn danh mục</label>
            <select name="hide" class="w-full border-gray-300 rounded-lg px-4 py-2">
                <option value="0" {{ $category->hide == 0 ? 'selected' : '' }}>Hiển thị</option>
                <option value="1" {{ $category->hide == 1 ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Cập nhật
        </button>
        <a href="{{ route('admin.categories') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all ml-2">
                Hủy
            </a>
    </form>
@endsection
