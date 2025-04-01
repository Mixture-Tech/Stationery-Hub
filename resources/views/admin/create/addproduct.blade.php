@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Thêm sản phẩm mới</h2>

    @if (session('error'))
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.addProductPost') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <div class="mb-4">
            <label class="block font-bold mb-2">Tên sản phẩm</label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
            @error('name')
                <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Số lượng</label>
            <input type="number" name="nums" class="w-full border-gray-300 rounded-lg px-4 py-2" required min="1">
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Giá</label>
            <input type="number" id="price" name="price" class="w-full border-gray-300 rounded-lg px-4 py-2" required min="1" step="0.01" oninput="calculateDiscount()">
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Giảm giá (%)</label>
            <input type="number" id="discount" name="discount" class="w-full border-gray-300 rounded-lg px-4 py-2" min="0" max="100" oninput="calculateDiscount()">
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Giá sau giảm</label>
            <input type="hidden" id="discount_price" name="discount_price">
            <input type="text" id="discount_price_display" class="w-full border-gray-300 rounded-lg px-4 py-2 bg-gray-100 cursor-not-allowed" readonly>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Tên thương hiệu</label>
            <input type="text" name="brand" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-bold mb-2">Hình ảnh</label>
            <input type="file" name="image" class="w-full border-gray-300 rounded-lg px-4 py-2" required>
        </div>

        <div class="mb-4">
            <label for="id_category" class="block font-bold mb-2">Danh mục</label>
            <select name="id_category" class="w-full border border-gray-300 rounded px-4 py-2" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
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
            <a href="{{ route('admin.products') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2 hover:bg-gray-600 transition-all">
                Hủy
            </a>
        </div>
    </form>

    <script>
        function calculateDiscount() {
            let price = parseFloat(document.getElementById("price").value) || 0;
            let discount = parseFloat(document.getElementById("discount").value) || 0;
            let discountPrice = price * (1 - discount / 100);

            document.getElementById("discount_price").value = discountPrice.toFixed(2);
            document.getElementById("discount_price_display").value = discountPrice.toFixed(2) + " VNĐ";
        }
    </script>
@endsection
