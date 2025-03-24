    @extends('admin.admin')

    @section('content')
        <h2 class="text-2xl font-bold mb-4">Products</h2>

       <!-- Form tìm kiếm -->
        <div class="mb-4">
            <form action="{{ route('admin.products') }}" method="GET" class="flex items-center flex-wrap gap-2">
                <input type="text" name="search" placeholder="Tìm kiếm theo tên sản phẩm..." 
                    value="{{ request('search') }}" 
                    class="border border-gray-300 rounded-lg px-4 py-2 w-1/3 min-w-[200px]">
                
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    🔍 Tìm kiếm
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.products') }}"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition inline-flex items-center">
                        Xóa tìm kiếm
                    </a>
                @endif
            </form>
        </div>

        <div class="mb-4 flex justify-between items-center">
            <a href="{{ route('admin.addProduct') }}" 
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-all">
                ➕ Thêm sản phẩm mới
            </a>
        </div>



        @if($products->isEmpty())
            <p class="text-gray-500">Không có sản phẩm nào để hiển thị.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow-md border border-gray-300">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="border border-gray-300 px-4 py-2">ID</th>
                            <th class="border border-gray-300 px-4 py-2">Tên sản phẩm</th>
                            <th class="border border-gray-300 px-4 py-2">Danh mục</th>
                            <th class="border border-gray-300 px-4 py-2">Danh mục cha</th>
                            <th class="border border-gray-300 px-4 py-2">Giá</th>
                            <th class="border border-gray-300 px-4 py-2">Giá giảm</th>
                            <th class="border border-gray-300 px-4 py-2">Số lượng</th>
                            <th class="border border-gray-300 px-4 py-2">Thương hiệu</th>
                            <th class="border border-gray-300 px-4 py-2">Giảm giá (%)</th>
                            <th class="border border-gray-300 px-4 py-2">Hình ảnh</th>
                            <th class="border border-gray-300 px-4 py-2">Trạng thái</th>
                            <th class="border border-gray-300 px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2">{{ $product->id_product }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ optional($product->category)->name_category ?? 'Không có danh mục' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ optional(optional($product->category)->parent)->name_parent ?? 'Không có danh mục cha' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->discount_price ? number_format($product->discount_price, 0, ',', '.') . ' VNĐ' : 'N/A' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->nums }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->brand ?? 'Không có thương hiệu' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->discount ?? 0 }}%</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        Không có ảnh
                                    @endif
                                </td>
                                <td class="border bordor-gray-300 py-3 px-4">
                                    @if($product->hide == 0)
                                        <span class="text-green-600 font-semibold">Hiển thị</span>
                                    @else
                                        <span class="text-red-600 font-semibold">Ẩn</span>
                                    @endif
                                </td>

                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <a href="{{ route('admin.updateProduct', $product->id_product) }}" 
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
                {{ $products->links() }}
            </div>
        @endif
    @endsection
