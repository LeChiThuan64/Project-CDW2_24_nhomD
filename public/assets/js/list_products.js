document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.product-cell[data-bs-target="#productModal"]').forEach(cell => {
        cell.addEventListener('click', function () {
            const productRow = this.closest('tr');
            const productId = productRow.getAttribute('data-id');
            const productName = productRow.children[1].innerText;
            const productDescription = productRow.children[2].innerText;
            const sizesAndColors = JSON.parse(productRow.getAttribute('data-sizes-and-colors')) || [];
            const images = JSON.parse(productRow.getAttribute('data-images')) || []; // Thêm dòng này để lấy ảnh

            // Hiển thị thông tin trong modal
            document.getElementById('product-id').innerText = productId;
            document.getElementById('product-name').innerText = productName;
            document.getElementById('product-description').innerText = productDescription;

            // Xóa dữ liệu cũ
            const productDetailsBody = document.getElementById('product-details-body');
            productDetailsBody.innerHTML = '';

            // Thêm thông tin màu sắc và kích thước vào bảng
            sizesAndColors.forEach(sizeColor => {
                const row = `<tr>
                                <td>${sizeColor.color.name}</td>
                                <td>${sizeColor.size.name}</td>
                                <td>${sizeColor.quantity}</td>
                                <td>${sizeColor.price}</td>
                             </tr>`;
                productDetailsBody.innerHTML += row;
            });

            // Xóa ảnh cũ trong modal
            const productImagesContainer = document.getElementById('product-images');
            productImagesContainer.innerHTML = ''; // Xóa ảnh cũ
            console.log(images); // Kiểm tra giá trị của images

            // Thêm ảnh vào modal
            images.forEach(imageUrl => {
                const imgElement = `<div class="col-3" style="display: flex; justify-content: center;">
                                        <img src="${imageUrl}" alt="Product Image" class="img-fluid" style="max-width: 100%; height: auto;">
                                    </div>`;
                productImagesContainer.innerHTML += imgElement;
            });
            
            
        });
    });

    // Xóa
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
            success: function(result) {
                rowToDelete.remove();
                $('#deleteConfirmationModal').modal('hide');
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra. Vui lòng thử lại.');
            }
        });
    });
  
    function showNotification() {
        const notificationWrapper = document.getElementById('notification-wrapper');
        
        // Hiển thị thông báo
        notificationWrapper.classList.add('show');
    
        // Ẩn thông báo sau 2 giây
        setTimeout(() => {
            notificationWrapper.classList.remove('show');
        }, 2000);
    }
        
    // Gọi hàm khi cần hiển thị thông báo
    showNotification();




    // Lọc
    
});
