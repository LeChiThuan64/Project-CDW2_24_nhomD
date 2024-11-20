document.addEventListener('DOMContentLoaded', function() {
    console.log('order_details.js loaded');
    const url = window.location.pathname;
    const orderId = url.split('/')[2]; // Giả sử URL có dạng /orders/{orderId}/detail

    document.getElementById('edit-info-btn').addEventListener('click', function() {
        document.getElementById('address-display').style.display = 'none';
        document.getElementById('phone-display').style.display = 'none';
        document.getElementById('email-display').style.display = 'none';
        document.getElementById('address-input').style.display = 'block';
        document.getElementById('phone-input').style.display = 'block';
        document.getElementById('email-input').style.display = 'block';
        document.getElementById('edit-info-btn').style.display = 'none';
        document.getElementById('back-info-btn').style.display = 'none';
        document.getElementById('save-info-btn').style.display = 'inline-block';
        document.getElementById('cancel-info-btn').style.display = 'inline-block';
    });

    document.getElementById('cancel-info-btn').addEventListener('click', function() {
        document.getElementById('address-display').style.display = 'block';
        document.getElementById('phone-display').style.display = 'block';
        document.getElementById('email-display').style.display = 'block';
        document.getElementById('address-input').style.display = 'none';
        document.getElementById('phone-input').style.display = 'none';
        document.getElementById('email-input').style.display = 'none';
        document.getElementById('edit-info-btn').style.display = 'inline-block';
        document.getElementById('back-info-btn').style.display = 'inline-block';
        document.getElementById('save-info-btn').style.display = 'none';
        document.getElementById('cancel-info-btn').style.display = 'none';
    });

    document.getElementById('save-info-btn').addEventListener('click', function() {
            // Lấy orderId từ URL
        const address = document.getElementById('address-input').value;
        const phone = document.getElementById('phone-input').value;
        const email = document.getElementById('email-input').value;

        // Kiểm tra điều kiện cho số điện thoại
        if (!address) {
            alert('Địa chỉ không được để trống.');
            return;
        }
        // Kiểm tra điều kiện cho số điện thoại
        if (!phone) {
            alert('Số điện thoại không được để trống.');
            return;
        }        
        // Kiểm tra điều kiện cho số điện thoại
        const phonePattern = /^[0-9]{10}$/;
        if (!phonePattern.test(phone)) {
            alert('Số điện thoại phải là 10 chữ số.');
            return;
        }

        // Kiểm tra điều kiện cho email
        if (!email) {
            alert('Email không được để trống.');
            return;
        }
        // Kiểm tra điều kiện cho email
        const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
        if (!emailPattern.test(email)) {
            alert('Email phải có đuôi @gmail.com.');
            return;
        }
        console.log(orderId);
        fetch(`/orders/${orderId}/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                address: address,
                phone: phone,
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('address-display').textContent = address;
                document.getElementById('phone-display').textContent = phone;
                document.getElementById('email-display').textContent = email;
                document.getElementById('cancel-info-btn').click();
            } else {
                alert('Cập nhật thông tin thất bại. Vui lòng thử lại.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const resendOrderBtn = document.getElementById('resend-order-btn');
    if (resendOrderBtn) {
        resendOrderBtn.addEventListener('click', function() {
            const orderId = this.getAttribute('data-order-id');
            console.log(orderId); // Kiểm tra giá trị orderId
            // Gửi yêu cầu thay đổi trạng thái đơn hàng sang "pending"
            fetch(`/orders/${orderId}/resend`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: 'pending' })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Đơn hàng đã được gửi lại thành công.');
                    location.reload(); // Tải lại trang để cập nhật trạng thái đơn hàng
                } else {
                    console.error('Server response:', data);
                    alert('Không thể gửi lại đơn hàng. Vui lòng thử lại.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Đã xảy ra lỗi. Vui lòng thử lại.');
            });
        });
    }

    
});