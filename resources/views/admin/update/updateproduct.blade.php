@extends('admin.admin')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Cập nhật sản phẩm</h2>
    <form action="{{ route('admin.updateProductPost', $product->id_product) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block font-bold mb-2">Tên sản phẩm</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Số lượng</label>
        <input type="number" name="nums" value="{{ $product->nums }}" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Giá</label>
        <input type="number" id="price" name="price" value="{{ $product->price }}" class="w-full border border-gray-400 rounded-lg px-4 py-2" required min="1" step="0.01"  oninput="calculateDiscount()">
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Giảm giá (%)</label>
        <input type="number" id="discount" name="discount" value="{{ $product->discount }}" class="w-full border border-gray-400 rounded-lg px-4 py-2" min="0" max="100" required oninput="calculateDiscount()">
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Giá sau giảm</label>
        <input type="hidden" id="discount_price" name="discount_price" value="{{ $product->discount_price }}">
        <input type="text" id="discount_price_display" class="w-full border border-gray-400 rounded-lg px-4 py-2 bg-gray-100 cursor-not-allowed" readonly>
    </div>
    <div class="mb-4">
        <label class="block font-bold mb-2">Thương hiệu</label>
        <input type="text" name="brand" value="{{ $product->brand }}" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Hình ảnh</label>
        <input type="file" name="image" class="w-full border border-gray-400 rounded-lg px-4 py-2">
        @if($product->image)
            @if(file_exists(public_path('storage/' . $product->image)))
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="Hình ảnh sản phẩm"
                     class="mt-2 w-32 h-32 object-cover rounded-lg border border-gray-400">
            @else
                <img src="{{ $product->image }}"
                     alt="Hình ảnh sản phẩm"
                     class="mt-2 w-32 h-32 object-cover rounded-lg border border-gray-400">
            @endif
        @endif
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Danh mục</label>
        <select name="id_category" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
            @foreach($categories as $category)
                <option value="{{ $category->id_category }}" {{ $product->id_category == $category->id_category ? 'selected' : '' }}>
                    {{ $category->name_category }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-bold mb-2">Ẩn sản phẩm</label>
        <select name="hide" class="w-full border border-gray-400 rounded-lg px-4 py-2" required>
            <option value="0" {{ $product->hide == 0 ? 'selected' : '' }}>Hiển thị</option>
            <option value="1" {{ $product->hide == 1 ? 'selected' : '' }}>Ẩn</option>
        </select>
    </div>

    <div class="flex items-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
            Cập nhật
        </button>
        <a href="{{ route('admin.products') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-all ml-2">
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

        // Gán giá trị hiển thị ban đầu
        window.onload = function() {
            document.getElementById("discount_price_display").value = document.getElementById("discount_price").value + " VNĐ";
        };
    </script>
@endsection
