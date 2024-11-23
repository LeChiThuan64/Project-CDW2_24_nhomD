document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.product-cell[data-bs-target="#productModal"]').forEach(cell => {
        cell.addEventListener('click', function () {
            const productRow = this.closest('tr');
            const productId = productRow.getAttribute('data-id');
            const productName = productRow.children[1].innerText;
            
            // Lấy mô tả đầy đủ từ data-description
            const productDescription = productRow.children[2].getAttribute('data-description');
            
            const sizesAndColors = JSON.parse(productRow.getAttribute('data-sizes-and-colors')) || [];
            const images = JSON.parse(productRow.getAttribute('data-images')) || [];
        
            document.getElementById('product-id').innerText = productId;
            document.getElementById('product-name').innerText = productName;
            
            // Hiển thị mô tả đầy đủ với định dạng HTML trong modal
            document.getElementById('product-description').innerHTML = productDescription;
        
            const productDetailsBody = document.getElementById('product-details-body');
            productDetailsBody.innerHTML = '';
        
            sizesAndColors.forEach(sizeColor => {
                const row = `<tr>
                                <td>${sizeColor.color.name}</td>
                                <td>${sizeColor.size.name}</td>
                                <td>${sizeColor.quantity}</td>
                                <td>${sizeColor.price}</td>
                            </tr>`;
                productDetailsBody.innerHTML += row;
            });
        
            const productImagesContainer = document.getElementById('product-images');
            productImagesContainer.innerHTML = '';
        
            images.forEach(imageUrl => {
                const imgElement = `<div class="col-3" style="display: flex; justify-content: center;">
                                        <img src="${imageUrl}" alt="Product Image" class="img-fluid" style="max-width: 100%; height: auto;">
                                    </div>`;
                productImagesContainer.innerHTML += imgElement;
            });
        });
        
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let productIdToDelete;
let rowToDelete;

$(document).on('click', '.delete-product', function () {
    productIdToDelete = $(this).data('id');
    rowToDelete = $(this).closest('tr');
    $('#deleteConfirmationModal').modal('show');
});

$('#confirmDeleteButton').click(function () {
    $.ajax({
        url: '/products/destroy/' + productIdToDelete,
        type: 'DELETE',
        success: function (result) {
            // Hiển thị thông báo thành công
            // alert(result.success);
            rowToDelete.remove();
            $('#deleteConfirmationModal').modal('hide');
        },
        error: function (xhr) {
            // Xử lý phản hồi lỗi
            let errorMessage = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Có lỗi xảy ra. Vui lòng thử lại.';
            alert(errorMessage);
        }
    });
});


    function showNotification() {
        const notificationWrapper = document.getElementById('notification-wrapper');

        notificationWrapper.classList.add('show');
        setTimeout(() => {
            notificationWrapper.classList.remove('show');
        }, 2000);
    }

    function debounce(func, delay) {
        let timeoutId;
        return function (...args) {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => func.apply(this, args), delay);
        };
    }

    const searchInput = document.getElementById('searchInput');
    const suggestionList = document.getElementById('suggestionList');

    if (!searchInput || !suggestionList) {
        console.error("Không tìm thấy phần tử 'searchInput' hoặc 'suggestionList'");
        return;
    }

    let lastKeyword = '';

    // Hàm tìm kiếm sản phẩm
    async function searchProducts() {
        const keyword = searchInput.value;

        // Chỉ thực hiện tìm kiếm nếu từ khóa đã thay đổi
        if (keyword !== lastKeyword) {
            lastKeyword = keyword; // Cập nhật từ khóa cuối cùng

            if (keyword.length > 1) { // Chỉ tìm kiếm khi từ khóa dài hơn 1 ký tự
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                try {
                    const response = await fetch('/search', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ keyword: keyword })
                    });

                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    const products = await response.json();
                    suggestionList.innerHTML = ''; // Xóa kết quả cũ

                    if (products.length > 0) {
                        suggestionList.classList.add('show'); // Hiện danh sách gợi ý
                        products.forEach(product => {
                            const li = document.createElement('li');
                            li.classList.add('list-group-item');

                            // Đánh dấu từ khóa
                            const keyword = searchInput.value; // Lấy từ khóa
                            li.innerHTML = product.name; // Sử dụng innerHTML để đánh dấu

                            // Gọi hàm highlightKeyword để đánh dấu từ khóa
                            highlightKeyword(li, keyword); // Đánh dấu từ khóa trong li

                            li.onclick = function (event) {
                                event.preventDefault(); // Ngăn chặn sự kiện mặc định
                                searchInput.value = product.name; // Đặt giá trị vào ô tìm kiếm
                                suggestionList.innerHTML = ''; // Xóa gợi ý
                                suggestionList.classList.remove('show'); // Ẩn gợi ý

                                // Tìm và submit form
                                const form = document.querySelector('form'); // Lấy form
                                if (form) {
                                    form.submit(); // Thực hiện submit form
                                }
                            };
                            suggestionList.appendChild(li);
                        });
                    } else {
                        suggestionList.classList.remove('show'); // Ẩn nếu không có gợi ý
                    }

                } catch (error) {
                    console.error("Lỗi khi tìm kiếm:", error);
                }
            } else {
                suggestionList.classList.remove('show'); // Ẩn nếu không có từ khóa
            }
        }
    }



    // Sử dụng debounce với độ trễ 300ms
    searchInput.addEventListener('input', debounce(searchProducts, 300));

    // Thêm sự kiện click cho toàn bộ tài liệu
    document.addEventListener('click', function (event) {

        // console.log('Document clicked:', event.target);
        // Kiểm tra nếu click nằm ngoài searchInput và suggestionList
        if (event.target !== searchInput && !suggestionList.contains(event.target)) {
            suggestionList.innerHTML = ''; // Xóa nội dung gợi ý
            suggestionList.classList.remove('show'); // Ẩn danh sách gợi ý
        }
    });


    function highlightKeyword(text, keyword) {
        const instance = new Mark(text);
        instance.unmark({
            done: function () {
                instance.mark(keyword, {
                    className: 'highlight' // Bạn có thể tùy chỉnh class này
                });
            }
        });
    }



    const categoryItems = document.querySelectorAll('.dropdown-item');
    const selectedCategoryIdInput = document.getElementById('selectedCategoryId');

    categoryItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định
            const categoryId = this.getAttribute('data-category-id');
            selectedCategoryIdInput.value = categoryId; // Lưu ID danh mục vào trường ẩn
            document.getElementById('categoryDropdown').innerText = this.innerText; // Cập nhật nút dropdown
        });
    });
    
    // Lắng nghe sự kiện click vào nút "Sửa"
    const editButtons = document.querySelectorAll('.edit-product');

editButtons.forEach(button => {
    button.addEventListener('click', function() {
        const encryptedId = this.getAttribute('data-id'); // Lấy mã hóa ID
        window.location.href = `/product/edit/${encryptedId}`;
    });
});


});

setTimeout(function() {
    var successMessage = document.getElementById('success-message');
    if (successMessage) {
        successMessage.style.display = 'none';
    }
  
    var failureMessage = document.getElementById('failure-message');
    if (failureMessage) {
        failureMessage.style.display = 'none';
    }
  }, 3000);

  function showReplyForm(reviewId) {
    var replyForm = document.getElementById('reply-form-' + reviewId);
    replyForm.style.display = replyForm.style.display === 'none' ? 'block' : 'none';
}

