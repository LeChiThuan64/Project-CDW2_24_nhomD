function showCancelForm(orderId) {
    document.getElementById('orderId').value = orderId;
    document.getElementById('cancelOrderFormContainer').style.display = 'block';
}

document.getElementById('closeForm').addEventListener('click', function() {
    document.getElementById('cancelOrderFormContainer').style.display = 'none';
});

// Thêm sự kiện nhấn nút cho các nút "HỦY ĐƠN HÀNG"
document.querySelectorAll('.btn-cancel').forEach(button => {
    button.addEventListener('click', function() {
        const orderId = this.getAttribute('data-order-id');
        showCancelForm(orderId);
    });
});
// Hiển thị textarea khi chọn lý do "Khác"
document.querySelectorAll('input[name="cancelReason"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const otherReasonContainer = document.getElementById('otherReasonContainer');
        if (this.value === 'Khác') {
            otherReasonContainer.style.display = 'block';
        } else {
            otherReasonContainer.style.display = 'none';
        }
    });
});
// Thêm sự kiện nhấn nút cho các nút "XEM ĐƠN HÀNG"
document.querySelectorAll('.btn-view').forEach(button => {
    button.addEventListener('click', function() {
        const orderId = this.getAttribute('data-order-id');
        showOrderDetail(orderId);
    });
});
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-received').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            document.getElementById('receivedOrderId').value = orderId;
            document.getElementById('receivedOrderFormContainer').style.display = 'block';
        });
    });

    document.getElementById('closeReceivedForm').addEventListener('click', function() {
        document.getElementById('receivedOrderFormContainer').style.display = 'none';
    });

    document.getElementById('confirmReceived').addEventListener('click', function() {
        const orderId = document.getElementById('receivedOrderId').value;
        // Gửi yêu cầu xác nhận đã nhận hàng đến server
        fetch(`/orders/${orderId}/received`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ orderId: orderId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Xác nhận đã nhận hàng thành công.');
                document.getElementById('receivedOrderFormContainer').style.display = 'none';
                location.reload(); // Tải lại trang để cập nhật trạng thái đơn hàng
                // Cập nhật trạng thái đơn hàng trên giao diện nếu cần
            } else {
                alert('Xác nhận đã nhận hàng thất bại. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        });
    });

    // Thêm sự kiện nhấn nút cho các nút "Chi tiết lỗi"
    document.querySelectorAll('.btn-error-detail').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Click');
            const orderId = this.getAttribute('data-order-id');
            // Fetch error details using orderId
            fetch(`/orders/${orderId}/error-details`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update table with error details
                    document.getElementById('errorOrderId').textContent = data.errorDetails.orderId;
                    document.getElementById('errorType').textContent = data.errorDetails.errorType;
                    document.getElementById('errorDescription').textContent = data.errorDetails.errorDescription;

                    // Show the table
                    document.getElementById('errorDetailTable').style.display = 'block';
                } else {
                    alert('Không thể lấy chi tiết lỗi. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            });
        });
    });
    document.getElementById('closeErrorDetailTable').addEventListener('click', function() {
        // Hide the table
        document.getElementById('errorDetailTable').style.display = 'none';
    });
    
});
document.addEventListener('DOMContentLoaded', function() {
    // Hiển thị form hủy đơn hàng khi nhấn nút "HỦY ĐƠN HÀNG"
    document.querySelectorAll('.btn-cancel').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            document.getElementById('orderId').value = orderId;
            document.getElementById('cancelOrderFormContainer').style.display = 'block';
        });
    });

    // Đóng form hủy đơn hàng khi nhấn nút "Đóng"
    document.getElementById('closeForm').addEventListener('click', function() {
        document.getElementById('cancelOrderFormContainer').style.display = 'none';
    });

    // Gửi yêu cầu hủy đơn hàng khi nhấn nút "Xác nhận hủy"
    const confirmCancelBtn = document.getElementById('confirmCancel');
    if (confirmCancelBtn) {
        confirmCancelBtn.addEventListener('click', function() {
            const orderId = document.getElementById('orderId').value;
            const cancelReason = document.querySelector('input[name="cancelReason"]:checked').value;
            const otherReason = document.getElementById('otherReason').value;
            console.log(orderId); // Kiểm tra giá trị orderId
            // Gửi yêu cầu thay đổi trạng thái đơn hàng sang "cancelled"
            fetch(`/orders/${orderId}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ cancelReason: cancelReason, otherReason: otherReason })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Đơn hàng đã được hủy thành công.');
                    location.reload(); // Tải lại trang để cập nhật trạng thái đơn hàng
                } else {
                    console.error('Server response:', data);
                    alert('Không thể hủy đơn hàng. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            });
        });
    }
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.return-order').forEach(function (button) {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-id');
            window.location.href = `/returns-order/${orderId}`;
        });
    });
});