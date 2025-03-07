document.addEventListener('DOMContentLoaded', function () {
    const items = document.querySelectorAll('[data-carousel-item]');
    const prev = document.querySelector('[data-carousel-prev]');
    const next = document.querySelector('[data-carousel-next]');
    let current = 0;

    function showSlide(index) {
        items.forEach(item => item.classList.add('hidden'));
        items[index].classList.remove('hidden');
    }

    prev.addEventListener('click', () => {
        current = (current - 1 + items.length) % items.length;
        showSlide(current);
    });

    next.addEventListener('click', () => {
        current = (current + 1) % items.length;
        showSlide(current);
    });

    showSlide(current);
});
