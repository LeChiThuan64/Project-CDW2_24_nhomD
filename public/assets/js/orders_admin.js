document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-orders-confirm').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            const url = `/admin/orders/${orderId}/confirm`;
            console.log('Fetching URL:', url); // Kiểm tra URL
            // Gửi yêu cầu thay đổi trạng thái đơn hàng sang "on delivery"
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: 'on delivery' })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Đơn hàng đã được xác nhận và đang giao hàng.');
                    location.reload(); // Tải lại trang để cập nhật trạng thái đơn hàng
                } else {
                    console.error('Server response:', data);
                    alert('Không thể xác nhận đơn hàng. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            });
        });
    });
    document.querySelectorAll('.btn-error-detail').forEach(button => {
        button.addEventListener('click', function() {
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
                    // Lấy văn bản của tùy chọn radio được chọn
                    const selectedRadio = document.querySelector('input[name="errorType"]:checked');
                    let errorTypeText = '';
                    if (selectedRadio) {
                        const label = document.querySelector(`label[for="${selectedRadio.id}"]`);
                        errorTypeText = label ? label.textContent : '';
                    }
    
                    // Update table with error details
                    document.getElementById('errorOrderId').textContent = data.errorDetails.orderId;
                    document.getElementById('errorType').textContent = errorTypeText; // Sử dụng văn bản thay vì id
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

    // Chức năng báo lỗi cho khách hàng
    document.querySelectorAll('.btn-orders-fail').forEach(button => {
        button.addEventListener('click', function() {
            console.log("Ket noi button admin orders");
            const orderId = this.getAttribute('data-order-id');
            document.getElementById('errorOrderId').value = orderId;
            document.getElementById('errorReportFormContainer').style.display = 'block';
        });
    });

    document.getElementById('closeErrorReportForm').addEventListener('click', function() {
        document.getElementById('errorReportFormContainer').style.display = 'none';
    });

    document.getElementById('submitErrorReport').addEventListener('click', function() {
        const orderId = document.getElementById('errorOrderId').value;
        const errorType = document.querySelector('input[name="errorType"]:checked').value;
        const errorDescription = document.getElementById('errorDescription').value;
        // Gửi yêu cầu báo lỗi đến server
        fetch(`/admin/orders/${orderId}/report-error`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ orderId: orderId, errorType: errorType, errorDescription: errorDescription })
        })
        .then(response => response.text()) // Đổi từ .json() sang .text() để log phản hồi
        .then(data => {
            console.log(data); // Log phản hồi từ server
            try {
                data = JSON.parse(data); // Thử phân tích cú pháp JSON
                if (data.success) {
                    alert('Báo lỗi thành công.');
                    document.getElementById('errorReportFormContainer').style.display = 'none';
                    // Cập nhật trạng thái đơn hàng trên giao diện
                    const orderRow = document.querySelector(`button[data-order-id="${orderId}"]`).closest('tr');
                    orderRow.querySelector('.status').textContent = 'order fails';
                } else {
                    alert('Báo lỗi thất bại. Vui lòng thử lại.');
                }
            } catch (e) {
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        });
    });
    document.querySelectorAll('.btn-orders-delete').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            console.log(orderId); // Kiểm tra giá trị orderId
            // Gửi yêu cầu xóa đơn hàng
            fetch(`/orders/${orderId}/delete`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Đơn hàng đã được xóa thành công.');
                    location.reload(); // Tải lại trang để cập nhật danh sách đơn hàng
                } else {
                    console.error('Server response:', data);
                    alert('Không thể xóa đơn hàng. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            });
        });
    });
});