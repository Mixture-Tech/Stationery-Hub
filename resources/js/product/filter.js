document.addEventListener('DOMContentLoaded', function() {
    // Xử lý filter theo giá
    const priceCheckboxes = document.querySelectorAll('.price-checkbox');
    priceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Không bỏ chọn các checkbox khác để cho phép chọn nhiều khoảng giá
            // Submit form
            document.getElementById('price-filter-form').submit();
        });
    });

    // Xử lý sắp xếp
    const sortSelect = document.getElementById('sort-select');
    sortSelect.addEventListener('change', function() {
        redirectWithParams('sort', this.value);
    });

    // Xử lý số lượng sản phẩm trên trang
    const perPageSelect = document.getElementById('per-page-select');
    perPageSelect.addEventListener('change', function() {
        redirectWithParams('per_page', this.value);
    });

    // Xử lý hiển thị/ẩn danh mục con khi click vào danh mục cha (cho phiên bản JavaScript)
    const parentCategories = document.querySelectorAll('.font-medium a');
    parentCategories.forEach(parentCategory => {
        parentCategory.addEventListener('click', function(e) {
            // Nếu muốn hiển thị/ẩn ngay lập tức thay vì chuyển trang, hãy bỏ comment dòng dưới
            // e.preventDefault();
            
            // Lấy ID danh mục cha từ href
            const href = this.getAttribute('href');
            const parentId = href.split('parent_category=')[1];
            
            // Lấy phần tử chứa danh mục con
            const subcategoriesDiv = document.getElementById('subcategories-' + parentId);
            
            // Ẩn tất cả các danh mục con khác
            document.querySelectorAll('[id^="subcategories-"]').forEach(div => {
                if (div !== subcategoriesDiv) {
                    div.classList.add('hidden');
                }
            });
            
            // Hiển thị/ẩn danh mục con của danh mục cha được chọn
            if (subcategoriesDiv) {
                subcategoriesDiv.classList.toggle('hidden');
            }
        });
    });

    // Hàm chuyển hướng với các tham số
    function redirectWithParams(paramName, paramValue) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set(paramName, paramValue);
        window.location.href = `${window.location.pathname}?${urlParams.toString()}`;
    }
});
