@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Users</h2>

    <!-- form tìm kiếm user -->
    <div class="mb-4">
        <form action="{{ route('admin.users') }}" method="GET" class="flex items-center flex-wrap gap-2">
            <input type="text" name="search" placeholder="Tìm kiếm theo mã số, tên, hoặc email..." 
                value="{{ request('search') }}" 
                class="border border-gray-300 rounded-lg px-4 py-2 w-1/3 min-w-[200px]">
            
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                🔍 Tìm kiếm
            </button>

            @if(request('search'))
                <a href="{{ route('admin.users') }}"
                   class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition inline-flex items-center">
                    Xóa tìm kiếm
                </a>
            @endif
        </form>
    </div>

    @if($users->isEmpty())
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
                        <th class="border border-gray-300 px-4 py-2">Tên</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Chức Vụ</th>
                        <th class="border border-gray-300 px-4 py-2">Trạng Thái</th>
                        <th class="border border-gray-300 px-4 py-2">Ngày Tạo</th>
                        <th class="border border-gray-300 px-4 py-2">Ngày Cập Nhật</th>
                        <th class="border border-gray-300 px-4 py-2">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->id_user }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ optional($user->role)->name ?? 'N/A' }}</td>
                            <td class="border bordor-gray-300 py-3 px-4 text-center">
                                    @if($user->hide == 0)
                                        <span class="text-green-600 font-semibold">Hiển thị</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Ẩn</span>
                                    @endif
                                </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('admin.updateUser', $user->id_user) }}" 
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
            {{ $users->links() }}
        </div>
    @endif
@endsection