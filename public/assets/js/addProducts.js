// Initialize CKEditor on the specific textarea
document.addEventListener('DOMContentLoaded', function() {
    // Initialize CKEditor
    let productEditor;
    ClassicEditor.create(document.querySelector('#productContent'))
        .then(editor => {
            productEditor = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Prevent form submission if CKEditor content is empty
    document.querySelector('form').addEventListener('submit', function(event) {
        if (productEditor && !productEditor.getData().trim()) {
            alert('Nội dung sản phẩm không được để trống.');
            event.preventDefault(); // Prevent form submission
        }
    });
});




// Khai báo mảng để lưu trữ ID màu
const selectedColorIds = [];

// Function to handle color selection 
document.querySelectorAll('.color-button').forEach(button => {
    button.addEventListener('click', function() {
        const colorId = this.getAttribute('data-id'); // Lấy ID màu
        const colorName = this.getAttribute('data-color'); // Lấy tên màu
        const colorClass = this.className; // Lấy class của nút trong modal

        // Tạo nút màu mới
        const colorButton = document.createElement('button');
        colorButton.className = colorClass + ' ms-2'; // Dùng class của nút đã chọn để giữ màu chữ
        colorButton.textContent = colorName; // Tên của màu
        colorButton.setAttribute('data-id', colorId); // Lưu ID màu vào nút màu

        // Tạo nút "X" để xóa màu
        const removeButton = document.createElement('button');
        removeButton.className = 'remove-color';
        removeButton.innerHTML = '&times;'; // Ký hiệu "X"

        // Thêm event listener cho nút xóa
        removeButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Ngăn chặn sự kiện bùng nổ
            colorButtonsContainer.removeChild(colorButton); // Xóa nút màu
        });

        // Thêm nút "X" vào nút màu
        colorButton.appendChild(removeButton);

        // Thêm nút màu mới vào trước nút "+"
        const colorButtonsContainer = document.getElementById('colorButtons');
        const addButton = colorButtonsContainer.querySelector('[data-bs-target="#colorModal"]'); // Lấy nút "+"
        colorButtonsContainer.insertBefore(colorButton, addButton); // Thêm nút màu mới trước nút "+"

        // Ẩn modal
        const colorModal = bootstrap.Modal.getInstance(document.getElementById('colorModal'));
        colorModal.hide();
    });
});





// Function to handle image input
document.getElementById('chooseImageButton').addEventListener('click', function(event) {
    event.preventDefault(); // Ngăn chặn form submit
    document.getElementById('imageInput').click();
});

document.getElementById('imageInput').addEventListener('change', function(event) {
    const files = event.target.files;
    const container = document.getElementById('imagePlaceholderContainer');
    const imageNamesInput = document.getElementById('imageNames');
    let imageNames = imageNamesInput.value ? imageNamesInput.value.split(',') : []; // Lưu lại danh sách tên ảnh

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const imageIndex = imageNames.length; // Xác định chỉ số của ảnh mới
        imageNames.push(file.name); // Lưu tên hình ảnh vào mảng

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail w-100'; // Thêm class Bootstrap cho ảnh thumbnail, và w-100 để ảnh vừa với cột

            const imgPlaceholder = document.createElement('div');
            imgPlaceholder.className = 'col-md-6 mb-3 position-relative'; // Thêm col-md-6 để hiển thị 2 ảnh trên 1 hàng
            imgPlaceholder.appendChild(img);

            // Add remove functionality
            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;';
            closeButton.className = 'btn btn-danger btn-sm position-absolute'; // Dùng Bootstrap để định vị
            closeButton.style.top = '5px';
            closeButton.style.right = '5px';
            closeButton.addEventListener('click', function() {
                container.removeChild(imgPlaceholder);
                imageNames.splice(imageIndex, 1); // Xóa tên hình ảnh khỏi mảng
                imageNamesInput.value = imageNames.join(','); // Cập nhật trường ẩn với danh sách hình ảnh mới
            });

            imgPlaceholder.appendChild(closeButton);
            container.appendChild(imgPlaceholder);
        };

        reader.readAsDataURL(file);
    }

    imageNamesInput.value = imageNames.join(','); // Gán danh sách tên hình ảnh vào trường ẩn
});
