@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Category Parent</h2>

    <!-- Form tìm kiếm danh mục cha -->
    <div class="mb-4">
        <form action="{{ route('admin.categoryparents') }}" method="GET" class="flex items-center flex-wrap gap-2">
            <input type="text" name="search" placeholder="Tìm kiếm theo tên danh mục cha..."
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg px-4 py-2 w-1/3 min-w-[200px] text-center">

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                🔍 Tìm kiếm
            </button>

            @if(request('search'))
                <a href="{{ route('admin.categoryparents') }}"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition inline-flex items-center">
                    Xóa tìm kiếm
                </a>
            @endif
        </form>
    </div>

    <div class="mb-4 flex justify-between items-center">
        <a href="{{ route('admin.addParent') }}" 
        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-all">
            ➕ Thêm danh mục mới
        </a>
    </div>

    @if($categoryParents->isEmpty())
        <p class="text-gray-500 text-center">Không có danh mục nào để hiển thị.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md border border-gray-300">
                <thead>
                    <tr class="bg-blue-600 text-white text-center">
                        <th class="border border-gray-300 py-3 px-4">ID</th>
                        <th class="border border-gray-300 py-3 px-4">Tên danh mục</th>   
                        <th class="border border-gray-300 py-3 px-4">Trạng thái</th> 
                        <th class="border border-gray-300 py-3 px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categoryParents as $categoryParent)
                        <tr class="border-b hover:bg-gray-100 text-center">
                            <td class="border border-gray-300 py-3 px-4">{{ $categoryParent->id_parent }}</td>
                            <td class="border border-gray-300 py-3 px-4">{{ $categoryParent->name_parent }}</td>
                            <td class="border border-gray-300 py-3 px-4">
                                @if($categoryParent->hide == 0)
                                    <span class="text-green-600 font-semibold">Hiển thị</span>
                                @else
                                    <span class="text-red-600 font-semibold">Ẩn</span>
                                @endif
                            </td>

                            <td class="border border-gray-300 py-3 px-4">
                                <a href="{{ route('admin.updateParent', $categoryParent->id_parent) }}" 
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                    Cập nhật
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6 text-center">
            {{ $categoryParents->links() }}
        </div>
    @endif
@endsection
