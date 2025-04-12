@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Cập nhật danh mục Parent</h2>

    <form action="{{ route('admin.updateParentPost', $categoryparent->id_parent) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-bold mb-2">Tên danh mục</label>
            <input type="text" name="name_parent" value="{{ $categoryparent->name_parent }}" 
                class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-bold mb-2">Ẩn danh mục cha</label>
            <select name="hide" class="w-full border border-gray-400 rounded-lg px-4 py-2">
                <option value="0" {{ $categoryparent->hide == 0 ? 'selected' : '' }}>Hiển thị</option>
                <option value="1" {{ $categoryparent->hide == 1 ? 'selected' : '' }}>Ẩn</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Cập nhật
        </button>
        <a href="{{ route('admin.categoryparents') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all ml-2">
                Hủy
            </a>
    </form>
@endsection
