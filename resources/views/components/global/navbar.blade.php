<div class="bg-navy">
  <div class="py-2 w-4/5 mx-auto">
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
          
          <!-- Dropdown menu that appears on hover -->
          <div class="absolute top-full z-50 hidden w-[79vw] mx-[-215px] bg-white shadow-lg rounded-b-2xl group-hover:block">
              <div class="grid grid-cols-4 gap-4 p-4">
              <!-- Column 2: VĂN HỌC -->
              <div>
                <h3 class="font-bold text-black mb-3">VĂN HỌC</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiểu Thuyết</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Truyện Ngắn - Tản Văn</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Light Novel</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Ngôn Tình</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>

                <h3 class="font-bold text-black mb-3 mt-4">SÁCH THIẾU NHI</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Manga - Comic</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Kiến Thức Bách Khoa</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Sách Tranh Kỹ Năng Sống</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Vừa Học - Vừa Chơi</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>
              </div>

              <!-- Column 3: KINH TẾ & TÂM LÝ -->
              <div>
                <h3 class="font-bold text-black mb-3">KINH TẾ</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Nhân Vật - Bài Học Kinh Doanh</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Quản Trị - Lãnh Đạo</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Marketing - Bán Hàng</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Phân Tích Kinh Tế</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>

                <h3 class="font-bold text-black mb-3 mt-4">TIỂU SỬ - HỒI KÝ</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Câu Chuyện Cuộc Đời</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Chính Trị</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Kinh Tế</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Nghệ Thuật - Giải Trí</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>
              </div>

              <!-- Column 4: TÂM LÝ & NGOẠI NGỮ -->
              <div>
                <h3 class="font-bold text-black mb-3">TÂM LÝ - KỸ NĂNG SỐNG</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Kỹ Năng Sống</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Rèn Luyện Nhân Cách</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tâm Lý</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Sách Cho Tuổi Mới Lớn</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>

                <h3 class="font-bold text-black mb-3 mt-4">SÁCH HỌC NGOẠI NGỮ</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Anh</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Nhật</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Hoa</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Hàn</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>
              </div>

              <div>
                <h3 class="font-bold text-black mb-3">TÂM LÝ - KỸ NĂNG SỐNG</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Kỹ Năng Sống</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Rèn Luyện Nhân Cách</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tâm Lý</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Sách Cho Tuổi Mới Lớn</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>

                <h3 class="font-bold text-black mb-3 mt-4">SÁCH HỌC NGOẠI NGỮ</h3>
                <ul>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Anh</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Nhật</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Hoa</a></li>
                  <li class="mb-2"><a href="#" class="text-gray-700 hover:text-navy">Tiếng Hàn</a></li>
                  <li class="mb-1"><a href="#" class="text-dark-blue hover:text-medium-blue">Xem tất cả</a></li>
                </ul>
              </div>
            </div>
          </div>
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