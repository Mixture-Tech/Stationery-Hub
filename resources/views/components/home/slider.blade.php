@vite('resources/js/home/slide.js')

<div id="controls-carousel" class="relative w-full" data-carousel="static">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-[30px] md:h-96">
        <!-- Item 1 -->
        <div class="duration-700 ease-in-out" data-carousel-item>
            <img src="{{ Vite::asset('resources/images/slides/slide_1.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-[30px]" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="duration-700 ease-in-out" data-carousel-item="active">
            <img src="{{ Vite::asset('resources/images/slides/slide_2.jpg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-[30px]" alt="...">
        </div>

    </div>
    <!-- Slider controls -->
    <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <x-icon name="previous" />
            <span class="sr-only">Previous</span>
        </span>
    </button>
    <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
            <x-icon name="next" />
            <span class="sr-only">Next</span>
        </span>
    </button>
</div>