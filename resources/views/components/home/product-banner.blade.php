@props(['image', 'title' => ''])

<div class="rounded-lg overflow-hidden relative">
  <img src="{{ Vite::asset($image) }}" alt="{{ $title }}" class="w-full h-full object-cover">
  <div class="absolute bottom-0 w-full bg-dark-blue py-2 text-center">
    <button class="text-white text-md font-bold">Mua ngay</button>
  </div>
</div>