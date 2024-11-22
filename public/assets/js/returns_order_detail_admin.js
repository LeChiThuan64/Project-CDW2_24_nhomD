// public/js/returns_order_detail_admin.js

function showImageModal(src) {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    modal.style.display = "block";
    modalImg.src = src;
}

function closeImageModal() {
    var modal = document.getElementById("imageModal");
    modal.style.display = "none";
}

function submitReturnForm(button) {
    const form = document.getElementById('returnForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Lấy giá trị từ radio button được chọn
    const returnStatusElement = document.querySelector('input[name="return_status"]:checked');
    const returnStatus = returnStatusElement ? returnStatusElement.value : null;
    console.log('Return status:', returnStatus);
    // Lấy giá trị từ textarea
    const reason = document.getElementById('reason').value;
    console.log('Reason:', reason);
    if (!returnStatus) {
        alert('Vui lòng chọn trạng thái đổi trả.');
        return;
    }

    if (!reason) {
        alert('Vui lòng nhập lý do.');
        return;
    }
    const returnsOrderId = button.getAttribute('data-id');
    const productId = button.getAttribute('data-product-id');
    const ordersId = button.getAttribute('data-orders-id');
    // Tạo đối tượng JSON
    const formObject = {
        return_status: returnStatus,
        reason: reason,
        product_id: productId,
        orders_id: ordersId
    };
    fetch(`/returns-orders/${returnsOrderId}/store`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify(formObject)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Thành công');
            window.location.reload();
        } else {
            alert('Có lỗi xảy ra, vui lòng thử lại.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Có lỗi xảy ra, vui lòng thử lại.');
    });
}