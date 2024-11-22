function previewImage(event, previewId) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById(previewId);
        output.style.display = 'block'; // Hiển thị hình ảnh
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}

document.getElementById('returnsOrderForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    const productId = formData.get('product_id');
    const bankingId = formData.get('banking_id');
    console.log('Product ID:', productId); // Kiểm tra giá trị product_id
    console.log('Banking ID:', bankingId); // Kiểm tra giá trị banking_id
    const phone = formData.get('phone');
    const phonePattern = /^\d{10}$/;

    if (!productId) {
        alert('Vui lòng chọn sản phẩm.');
        console.log('Product ID is null or undefined');
        return;
    }

    if (!bankingId || bankingId === 'null') {
        alert('Vui lòng chọn ngân hàng.');
        console.log('Banking ID is null or undefined');
        return;
    }

    if (!phonePattern.test(phone)) {
        alert('Số điện thoại phải là số và đủ 10 số.');
        return;
    }

    console.log('Product ID:', productId); // Kiểm tra giá trị product_id
    console.log('Banking ID:', bankingId); // Kiểm tra giá trị banking_id

    fetch('/returns_order', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert('Yêu cầu đổi trả hàng đã được gửi thành công.');
            window.location.reload();
        } else {
            alert('Đã xảy ra lỗi. Vui lòng thử lại.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Đã xảy ra lỗi. Vui lòng thử lại.');
    });
});