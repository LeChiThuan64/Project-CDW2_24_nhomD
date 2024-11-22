document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn-view-return').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const orderId = this.getAttribute('data-id');
            console.log('Order ID:', orderId);
            fetchOrderDetails(orderId);
        });
    });

    document.getElementById('close-table').addEventListener('click', function() {
        document.getElementById('fixed-table').style.display = 'none';
    });

    document.getElementById('send-btn').addEventListener('click', function() {
        const returnsOrderId = this.getAttribute('data-returns-order-id');
        updateOrderStatus(returnsOrderId);
    });
});

async function fetchOrderDetails(orderId) {
    console.log("đã gọi đến hàm này")
    try {
        const response = await fetch('/api/order_return_results/' + orderId);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        console.log("Dữ liệu trả về từ API:", data);
        var detailsDiv = document.getElementById('order-details');
        
        detailsDiv.innerHTML = ''; // Xóa nội dung cũ nếu có

        data.forEach(async function(result) {
            var orderIdParagraph = document.createElement('p');
            orderIdParagraph.textContent = `Mã đơn hàng: ${result.order_id}`;
            detailsDiv.appendChild(orderIdParagraph);

            // Thực hiện yêu cầu API để lấy tên sản phẩm sau khi hiển thị mã đơn hàng
            try {
                const productResponse = await fetch(`/api/products/${result.product_id}`);
                if (!productResponse.ok) {
                    throw new Error('Network response was not ok');
                }
                const productData = await productResponse.json();
                var productNameParagraph = document.createElement('p');
                productNameParagraph.textContent = `Sản phẩm: ${productData.name}`;
                detailsDiv.appendChild(productNameParagraph);
            } catch (error) {
                console.error('Error fetching product data:', error);
            }

            // Hiển thị các thông tin khác
            var statusParagraph = document.createElement('p');
            statusParagraph.textContent = `Tình trạng: ${result.return_status}`;
            detailsDiv.appendChild(statusParagraph);

            var reasonParagraph = document.createElement('p');
            reasonParagraph.textContent = `Lý do: ${result.reason}`;
            detailsDiv.appendChild(reasonParagraph);

            var createdAtParagraph = document.createElement('p');
            createdAtParagraph.textContent = `Đã xử lý vào ngày: ${new Date(result.created_at).toLocaleDateString()}`;
            detailsDiv.appendChild(createdAtParagraph);

            // Kiểm tra nếu return_status là "Từ chối trả hàng" thì ẩn thông tin địa chỉ và số điện thoại
            if (result.return_status !== "Từ chối trả hàng") {
                var addressParagraph = document.createElement('p');
                addressParagraph.textContent = "Gửi sản phẩm về địa chỉ: 53 Võ Văn Ngân, Linh Chiểu, Tp Thủ Đức, Tp Hồ Chí Minh";
                detailsDiv.appendChild(addressParagraph);

                // Hiển thị nút "Đã gửi hàng" với dữ liệu returns_id order_id
                var sendButton = document.getElementById('send-btn');
                sendButton.style.display = 'inline-block';
                sendButton.setAttribute('data-returns-order-id', result.returns_order_id); // Gán giá trị order_id
            } else {
                // Ẩn nút "Đã gửi hàng" nếu "Từ chối trả hàng"
                document.getElementById('send-btn').style.display = 'none';
            }
            var contactParagraph = document.createElement('p');
            contactParagraph.textContent = "Thắc mắc liên hệ: +123456789";
            detailsDiv.appendChild(contactParagraph);
        });

        document.getElementById('fixed-table').style.display = 'block';
    } catch (error) {
        console.error('Error fetching order details:', error);
    }
}

function updateOrderStatus(returnsOrderId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/returns-orders/${returnsOrderId}/update-status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ status: 'Đã gửi sản phẩm' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Trạng thái đã được cập nhật thành "Đã gửi sản phẩm".');
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