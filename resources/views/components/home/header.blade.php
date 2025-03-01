<!-- Slider Section -->
<div class="relative w-full">
  <div class="w-4/5 mx-auto">
    <div class="flex h-full">
      <div class="w-3/4">
        @include('components.home.slider')
      </div>

      <div class="w-1/4 flex flex-col py-4 ps-4 gap-10">
        <div class="h-1/2 flex">
          <img src="{{ Vite::asset('resources/images/product-banner/product_banner_1.jpg') }}" alt="Gift box" class="rounded-3xl">
        </div>
        <div class="h-1/2 flex">
          <img src="{{ Vite::asset('resources/images/product-banner/product_banner_2.jpg') }}" alt="Gift box" class="rounded-3xl">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Promotional Categories -->
<div class="container w-4/5 mx-auto py-6">
  <div class="grid grid-cols-4 gap-4">
    <!-- Category 1 -->
    <x-home.product-banner
      image="resources/images/product-banner/product_banner_3.jpg"
      title="Siêu sale 3.3" />
    <!-- Category 2 -->
    <x-home.product-banner
      image="resources/images/product-banner/product_banner_4.jpg"
      title="Exclusive 3.3" />
    <!-- Category 3 -->
    <x-home.product-banner
      image="resources/images/product-banner/product_banner_5.jpg"
      title="Đón xuân sang" />
    <!-- Category 4 -->
    <x-home.product-banner
      image="resources/images/product-banner/product_banner_6.jpg"
      title="Máy tính chính hãng" />
  </div>
</div>