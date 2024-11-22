document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.btn-view-detail');
    viewButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const orderId = this.getAttribute('data-id');
            window.location.href = '/returns-orders/' + orderId;
        });
    });

    const receivedButtons = document.querySelectorAll('.btn-received');
    receivedButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const orderId = this.getAttribute('data-id');
            handleProductReceived(orderId);
        });
    });
});

function handleProductReceived(orderId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/orders/${orderId}/product-received`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Sản phẩm đã được nhận và cập nhật thành công.');
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