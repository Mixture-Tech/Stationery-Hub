document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('[data-carousel-item]');
    const prev = document.querySelector('[data-carousel-prev]');
    const next = document.querySelector('[data-carousel-next]');
    let current = 0;
    let autoSlide;

    // Hàm hiển thị slide
    function showSlide(index) {
        items.forEach(item => item.classList.add('hidden'));
        items[index].classList.remove('hidden');
    }

    // Chuyển slide tự động
    function startAutoSlide() {
        autoSlide = setInterval(() => {
            current = (current + 1) % items.length; // Chuyển sang slide tiếp theo
            showSlide(current);
        }, 2000); // 3000ms = 3 giây
    }

    // Dừng chuyển slide tự động (tuỳ chọn khi người dùng tương tác)
    function stopAutoSlide() {
        clearInterval(autoSlide);
    }

    // Xử lý nút Previous
    prev.addEventListener('click', () => {
        stopAutoSlide(); // Dừng tự động khi nhấn nút
        current = (current - 1 + items.length) % items.length;
        showSlide(current);
        startAutoSlide(); // Khởi động lại tự động
    });

    // Xử lý nút Next
    next.addEventListener('click', () => {
        stopAutoSlide(); // Dừng tự động khi nhấn nút
        current = (current + 1) % items.length;
        showSlide(current);
        startAutoSlide(); // Khởi động lại tự động
    });

    // Hiển thị slide đầu tiên và bắt đầu tự động chuyển
    showSlide(current);
    startAutoSlide();
});