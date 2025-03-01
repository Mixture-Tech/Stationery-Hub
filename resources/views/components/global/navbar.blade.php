<div class="bg-navy">
  <div class="py-2 px-6 w-4/5 mx-auto">
    <div class="flex justify-between">
      <div class="flex items-center">
        <img src="{{ Vite::asset('resources/images/logo/MIXTURE-TECH.png') }}" alt="Market Logo" class="h-10 w-48">
      </div>

      <div class="ml-6 flex flex-1 gap-x-3">
        <div class="flex cursor-pointer select-none items-center gap-x-2 rounded-md py-2 px-4 text-soft-gray hover:bg-medium-blue text-soft-gray">
          <x-icon name="menu-grid" class="h-5 w-5" />
        </div>

        <div class="relative w-full">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x-icon name="search" class="h-5 w-5 text-soft-gray" />
          </div>
          <input type="text" class="w-full rounded-md border border-soft-gray pl-10 py-2 text-sm text-soft-gray" placeholder="Search..." />
        </div>
      </div>

      <div class="ml-2 flex">
        <div class="flex cursor-pointer items-center gap-x-1 rounded-md py-2 px-4 hover:bg-medium-blue text-soft-gray">
          <x-icon name="order" class="h-5 w-5 text-soft-gray" />
          <span class="text-sm font-medium">Đơn hàng</span>
        </div>

        <div class="flex cursor-pointer items-center gap-x-1 rounded-md py-2 px-4 hover:bg-medium-blue text-soft-gray">
          <div class="relative">
            <x-icon name="cart" class="h-5 w-5 text-soft-gray" />
            <span class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 p-2 text-xs text-soft-gray">3</span>
          </div>
          <span class="text-sm font-medium text-soft-gray">Giỏ hàng</span>
        </div>

        <div class="ml-2 flex cursor-pointer items-center gap-x-1 rounded-md border border-soft-gray py-2 px-4 hover:bg-medium-blue text-soft-gray">
          <x-icon name="user" class="h-5 w-5 text-soft-gray" />
          <span class="text-sm font-medium">Đăng nhập</span>
        </div>
      </div>
    </div>

    <div class="mt-4 flex items-center justify-between">
      <div class="flex gap-x-2 py-1 px-2">
        <x-icon name="location" class="h-5 w-5 text-soft-gray" />
        <span class="text-sm font-medium text-soft-gray">Hutech</span>
      </div>

      <div class="flex gap-x-8">
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Bán chạy nhất</span>
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Sản phẩm mới</span>
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Sách</span>
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Máy tính</span>
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Đồ chơi</span>
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Mã giảm giá</span>
        <span class="cursor-pointer rounded-sm py-1 px-2 text-sm font-medium hover:bg-medium-blue text-soft-gray">Bán sỉ</span>
      </div>

      <div class="flex gap-x-2 py-1 px-2 cursor-pointer rounded-sm font-medium hover:bg-medium-blue">
        <x-icon name="thunder" class="h-5 w-5 text-soft-gray" />
        <span class="text-sm font-medium text-soft-gray">Flash Sale</span>
      </div>
    </div>
  </div>
</div>