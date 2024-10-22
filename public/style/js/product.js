document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM đã được tải');

    // Hàm để lấy ID sản phẩm từ URL
    function getProductIdFromUrl() {
        const url = window.location.href;
        const match = url.match(/\/product\/(\d+)/);
        return match ? match[1] : null;
    }

    // Lấy ID sản phẩm từ URL
    const currentProductId = getProductIdFromUrl();
    console.log(`Current Product ID: ${currentProductId}`); // Log ID sản phẩm hiện tại

    // Hàm để lấy thông tin chi tiết của sản phẩm từ server
    function fetchProductDetails(productId) {
        return fetch(`/search-product?product_id=${productId}`) // Gọi phương thức search
            .then(response => {
                console.log('Trạng thái phản hồi:', response.status); // Log trạng thái phản hồi
                if (!response.ok) {
                    throw new Error('Không thể lấy thông tin sản phẩm');
                }
                return response.json();
            })
            .then(data => {
                // Trả về thông tin sản phẩm nếu thành công
                return data.success ? data.product   : null; 
            })
            .catch(error => {
                console.error('Có lỗi xảy ra khi lấy thông tin sản phẩm:', error);
                return null; // Trả về null nếu có lỗi
            });
    }


    // Lấy thông tin chi tiết của sản phẩm 1 và cập nhật vào HTML
    if (currentProductId) {
        fetchProductDetails(currentProductId).then(product => {
            if (product) {
                document.getElementById('product1-name').textContent = product.name;
                console.log(`Tên sản phẩm 1: ${product.name}`); // Log tên sản phẩm 1
                const productDetails = `
                <div class="product-details product-1">
                    <div><strong>Name:</strong> ${product.name}</div>
                    <div><strong>Description:</strong> ${product.description}</div>
                    <div><strong>Price:</strong> ${product.price}</div>
                </div>
            `;
            document.querySelector('.details-card.product-1 span').innerHTML = productDetails;
            }
        });
    }    
    // Sự kiện click cho nút "So sánh ngay"
    document.querySelector('.btn-comparison').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('comparison-table').classList.toggle('d-none');
    });

    // Sự kiện click cho nút "Đóng" trong bảng so sánh
    document.querySelectorAll('.close-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            // Ẩn bảng so sánh
            document.querySelector('.comparison-section').classList.add('d-none');
            document.getElementById('comparison-table').classList.add('d-none');
        });
    });    
    // Sự kiện click cho nút "Thêm sản phẩm"
    document.querySelector('.btn-add-product').addEventListener('click', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a>
        const modal = document.getElementById('add-product-modal');
        modal.classList.remove('d-none'); // Xóa lớp d-none để hiển thị modal
        console.log('Modal đã được hiển thị:', modal.classList); // Xem lớp hiện tại của modal
    });
    // Sự kiện click cho nút "Đóng" trong modal "Add Product"
    document.querySelector('.close').addEventListener('click', function() {
        console.log('Nút đóng đã được nhấn');
        const modal = document.getElementById('add-product-modal');
        modal.classList.add('d-none');
        console.log('Modal đã bị ẩn:', modal.classList);
    });
    // Sự kiện nhập id và tên tìm kiếm sản phẩm
    document.getElementById('product-search').addEventListener('input', function(event) {
        const query = event.target.value;
        const resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = ''; // Xóa kết quả trước đó

        if (query) {
            fetch(`/search-product?product_id=${query}&product_name=${query}`) // URL phải đúng với route
                .then(response => {
                    console.log('Trạng thái phản hồi:', response.status); // Log trạng thái phản hồi
                    if (!response.ok) {
                        throw new Error('Phản hồi mạng không thành công');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const product = data.product;
                        const resultItem = document.createElement('div');
                        resultItem.classList.add('search-result-item');
                        resultItem.innerHTML = `
                            <span>${product.name}</span>
                            <button class="btn-add" data-product-id="${product.product_id}" data-product-name="${product.name}">Thêm sản phẩm</button>
                        `;
                        resultsContainer.appendChild(resultItem);
                    } else {
                        resultsContainer.innerHTML = '<div class="search-result-item">Không tìm thấy sản phẩm</div>';
                    }
                })
                .catch(error => {
                    console.error('Có lỗi xảy ra:', error);
                    resultsContainer.innerHTML = '<div class="search-result-item">Không tìm thấy sản phẩm</div>';
                });
        }
    });
        
    // Chức năng thêm sản phẩm vào mục so sánh
    document.getElementById('search-results').addEventListener('click', function(event) {
        console.log('Kết quả tìm kiếm đã được nhấn'); // Log khi kết quả tìm kiếm được nhấn
        if (event.target.classList.contains('btn-add')) {
            console.log('Nút thêm sản phẩm đã được nhấn'); // Log khi nút thêm sản phẩm được nhấn
            const product2name = event.target.getAttribute('data-product-name');
            const product2Id = event.target.getAttribute('data-product-id');
            console.log('Tên sản phẩm:', product2name); // Log tên sản phẩm
            console.log('ID sản phẩm:', product2Id); // Log ID sản phẩm

            // Kiểm tra nếu productId là null hoặc undefined
            if (!product2Id) {
                console.error('ID sản phẩm không hợp lệ:', product2Id);
                return;
            }
            
            // Cập nhật modal so sánh với tên sản phẩm
            document.getElementById('product-name').textContent = product2name;
            document.getElementById('add-product-modal').classList.add('d-none'); // Ẩn modal

            // Lấy thông tin chi tiết của sản phẩm 2 và cập nhật vào HTML
            if (product2Id) {
                fetchProductDetails(product2Id).then(product => {
                    if (product) {
                        const product2Details = `
                            <div class="product-details product-2">
                                <div><strong>Name:</strong> ${product.name}</div>
                                <div><strong>Description:</strong> ${product.description}</div>
                                <div><strong>Price:</strong> ${product.price}</div>
                            </div>
                        `;
                        document.querySelector('.details-card.product-2 span').innerHTML = product2Details;
                    }
                });
            }

            // Tạo thẻ h2 chứa tên sản phẩm và thêm vào div.comparison-item.product2
            const comparisonItem = document.querySelector('.comparison-item.product2');
            if (comparisonItem) {
                const productH2 = document.createElement('h2');
                productH2.textContent = product2name;
                productH2.setAttribute('data-product-id', product2Id); // Lưu trữ product_id trong thuộc tính data-
                comparisonItem.appendChild(productH2);
                console.log('Sản phẩm đã được thêm vào mục so sánh với ID:', product2Id); // Log khi sản phẩm được thêm

                // Ẩn nút "Thêm sản phẩm"
                const addButton = comparisonItem.querySelector('.btn-add-product');
                if (addButton) {
                    addButton.style.display = 'none';
                    console.log('Nút thêm sản phẩm đã bị ẩn'); // Log khi nút thêm sản phẩm bị ẩn
                } else {
                    console.log('Không tìm thấy nút thêm sản phẩm để ẩn'); // Log nếu không tìm thấy nút thêm sản phẩm
                }
                
                // Cập nhật tên sản phẩm trong phần tử .product-wrapper

                document.getElementById('product2-name').textContent = product2name;
                document.getElementById('product2-name').setAttribute('data-product-id', product2Id);
                console.log(`Product 2 - ID: ${product2Id}, Name: ${product2name}`); // Log ID và tên của sản phẩm 2
            } else {
                console.log('Không tìm thấy phần tử comparison-item.product2'); // Log nếu không tìm thấy phần tử comparison-item.product2
            }
        }
    }); 

    // Chức năng xóa tất cả sản phẩm khỏi mục so sánh
    document.querySelector('.comparison-item.btn-comparsion').addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-product')) {
            console.log('Nút xóa tất cả sản phẩm đã được nhấn'); // Log khi nút xóa tất cả sản phẩm được nhấn

            // Xóa tất cả thẻ h2 chứa tên sản phẩm và thuộc tính data-product-id
            const comparisonItems = document.querySelectorAll('.comparison-item.product2 h2');
            comparisonItems.forEach(function(item) {
                const productId = item.getAttribute('data-product-id');
                item.remove();
                console.log('Sản phẩm với ID', productId, 'đã được xóa khỏi mục so sánh'); // Log khi sản phẩm được xóa
            });

            // Hiển thị lại nút "Thêm sản phẩm"
            const addButtons = document.querySelectorAll('.comparison-item.product2 .btn-add-product');
            addButtons.forEach(function(button) {
                button.style.display = 'block';
                console.log('Nút thêm sản phẩm đã được hiển thị lại'); // Log khi nút thêm sản phẩm được hiển thị lại
            });
            // Đặt lại tên sản phẩm trong phần tử .product-wrapper
            document.getElementById('product2-name').textContent = 'Sản phẩm 2';
            document.getElementById('product2-name').removeAttribute('data-product-id');
            }
    });

    // Sự kiện click cho nút "So sánh ngay"
    document.querySelector('.btn-table.comparsion').addEventListener('click', function(event) {
        event.preventDefault();
        
        // Kiểm tra nếu không có sản phẩm nào được thêm vào mục so sánh
        const comparisonItem = document.querySelector('.comparison-item.product2');
        if (comparisonItem && comparisonItem.querySelectorAll('h2').length === 0) {
            alert('Vui lòng thêm sản phẩm so sánh');
            return;
        }
        
        // Hiển thị bảng so sánh
        document.querySelector('.comparison-section').classList.remove('d-none');
        
        // Đóng modal "Add Product"
        document.getElementById('add-product-modal').classList.add('d-none');
    });
});
