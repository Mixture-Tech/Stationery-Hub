@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Categories</h2>

    <!-- Form tìm kiếm danh mục -->
    <div class="mb-4">
        <form action="{{ route('admin.categories') }}" method="GET" class="flex items-center flex-wrap gap-2">
            <input type="text" name="search" placeholder="Tìm kiếm theo mã số, tên danh mục..."
                value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg px-4 py-2 w-1/3 min-w-[200px]">
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                🔍 Tìm kiếm
            </button>

            @if(request('search'))
                <a href="{{ route('admin.categories') }}"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition inline-flex items-center">
                Xóa tìm kiếm
                </a>
            @endif
        </form>
    </div>

    <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('admin.addCategory') }}" 
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-all">
                ➕ Thêm danh mục mới
            </a>
    </div>

    @if($categories->isEmpty())
        <p class="text-gray-500 text-center">Không có danh mục nào để hiển thị.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md border border-gray-300">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="border border-gray-300 py-3 px-4 text-center">ID</th>
                        <th class="border border-gray-300 py-3 px-4 text-center">Tên danh mục</th>   
                        <th class="border border-gray-300 py-3 px-4 text-center">Danh mục cha</th>
                        <th class="border border-gray-300 px-3 py-4 text-center">Trạng thái</th>
                        <th class="border border-gray-300 py-3 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="border border-gray-300 py-3 px-4 text-center">{{ $category->id_category }}</td>
                            <td class="border border-gray-300 py-3 px-4 text-center">{{ $category->name_category }}</td>
                            <td class="border border-gray-300 py-3 px-4 text-center">
                                {{ optional($category->parent)->name_parent ?? 'Không có danh mục' }}
                            </td>
                            <td class="border bordor-gray-300 py-3 px-4 text-center">
                                @if($category->hide == 0)
                                    <span class="text-green-600 font-semibold">Hiển thị</span>
                                @else
                                    <span class="text-red-600 font-semibold">Ẩn</span>
                                @endif
                            </td>

                            <td class="border border-gray-300 py-3 px-4 text-center">
                                <a href="{{ route('admin.updatecategory', $category->id_category) }}" 
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                    Cập nhật
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @endif
@endsection
