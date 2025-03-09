<div class="bg-navy">
  <div class="py-2 px-6 w-4/5 mx-auto">
    <div class="flex justify-between">
      <!-- Logo -->
      <div class="flex items-center">
        <img src="{{ Vite::asset('resources/images/logo/MIXTURE-TECH.png') }}" alt="Market Logo" class="h-10 w-48">
      </div>

      <!-- Tìm kiếm + Menu -->
      <div class="ml-6 flex flex-1 gap-x-3">
        <!-- Menu Grid -->
        <div class="flex cursor-pointer select-none items-center gap-x-2 rounded-md py-2 px-4 text-soft-gray hover:bg-medium-blue">
          <x-icon name="menu-grid" class="h-5 w-5" />
        </div>

        <!-- Ô tìm kiếm -->
        <div class="relative w-full">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <x-icon name="search" class="h-5 w-5" />
          </div>
          <input type="text" class="w-full rounded-md border border-soft-gray pl-10 py-2 text-sm text-black" placeholder="Search..." />
        </div>
      </div>

      <!-- Icons: Đơn hàng, Giỏ hàng, Đăng nhập -->
      <div class="ml-2 flex">
        <div class="flex cursor-pointer items-center gap-x-1 rounded-md py-2 px-4 hover:bg-medium-blue text-soft-gray">
          <x-icon name="order" class="h-5 w-5" />
          <span class="text-sm font-medium">Đơn hàng</span>
        </div>

        <div class="flex cursor-pointer items-center gap-x-1 rounded-md py-2 px-4 hover:bg-medium-blue text-soft-gray">
          <div class="relative">
            <x-icon name="cart" class="h-5 w-5 text-soft-gray" />
            <span class="absolute -top-2 -right-2 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 p-2 text-xs text-soft-gray">3</span>
          </div>
          <span class="text-sm font-medium">Giỏ hàng</span>
        </div>

        <!-- Dropdown đăng nhập -->
        <!-- Nút đăng nhập/đăng xuất -->
        <div class="relative ml-2">
          @auth
          <div x-data="{ open: false }" class="relative">
            <div @click="open = !open" class="flex cursor-pointer items-center gap-x-1 rounded-md border border-soft-gray py-2 px-4 hover:bg-medium-blue text-soft-gray">
              <x-icon name="user" class="h-5 w-5 text-soft-gray" />
              <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
            </div>

            <!-- Dropdown menu cho đăng xuất -->
            <div x-show="open" @click.outside="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
              <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Thông tin tài khoản</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Cài đặt</a>
              <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <x-responsive-nav-link class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" :href="route('logout')"
                  onclick="event.preventDefault();
                                          this.closest('form').submit();">
                  {{ __('Đăng xuất') }}
                </x-responsive-nav-link>
              </form>
            </div>
          </div>
          @else
          <a href="{{ route('login') }}" class="flex cursor-pointer items-center gap-x-1 rounded-md border border-soft-gray py-2 px-4 hover:bg-medium-blue text-soft-gray">
            <x-icon name="user" class="h-5 w-5 text-soft-gray" />
            <span class="text-sm font-medium">Đăng nhập</span>
          </a>
          @endauth
        </div>
      </div>
    </div>

    <!-- Danh mục -->
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