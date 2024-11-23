document.addEventListener('DOMContentLoaded', function () {

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
    document.querySelector('form').addEventListener('submit', function (event) {
        if (productEditor && !productEditor.getData().trim()) {
            // alert('Nội dung sản phẩm không được để trống.');
            event.preventDefault(); // Prevent form submission
        }


        const dataToSend = collectDataForSubmission();
        // Gửi dữ liệu đến controller thông qua form submission

        sendDataToServer(dataToSend).then(() => {
            // Allow the form to submit via the traditional method after data collection
            event.target.submit(); // or document.getElementById('submitForm').submit();
        }).catch(error => {
            console.error('Error in submission:', error);
        });
    });

    // Tự động tắt thông báo sau 3 giây
    setTimeout(function () {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.transition = 'opacity 0.5s';
            successMessage.style.opacity = 0; // Giảm độ sáng
            setTimeout(function () {
                successMessage.style.display = 'none'; // Ẩn thông báo
            }, 500); // Chờ cho đến khi hoàn thành hiệu ứng giảm sáng
        }
    }, 1500); // 3 giây

});

// Function to handle image input
document.getElementById('chooseImageButton').addEventListener('click', function (event) {
    event.preventDefault(); // Ngăn chặn form submit
    document.getElementById('imageInput').click();
});
const imageInput = document.getElementById('imageInput');
const container = document.getElementById('imagePlaceholderContainer');
const imageNamesInput = document.getElementById('imageNames');
let selectedFiles = []; // Mảng để giữ tất cả file đã chọn

imageInput.addEventListener('change', function (event) {
    const files = event.target.files; // Lấy danh sách file mới được chọn

    // Nếu đã có 4 ảnh, ngăn chặn việc thêm mới
    if (selectedFiles.length >= 4) {
        document.getElementById('chooseImageButton').disabled = true;
        return;
    }

    // Thêm file vào mảng selectedFiles nếu chưa có
    for (let i = 0; i < files.length; i++) {
        const file = files[i];

        // Giới hạn kích thước file
        if (file.size <= 1048576) { // 1 MB
            if (!selectedFiles.some(f => f.name === file.name)) { // Nếu file chưa có trong danh sách
                selectedFiles.push(file); // Thêm file vào mảng

                // Hiển thị ảnh đã chọn
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail w-100';

                    const imgPlaceholder = document.createElement('div');
                    imgPlaceholder.className = 'image-placeholder';
                    imgPlaceholder.appendChild(img);

                    // Thêm nút xóa ảnh
                    const closeButton = document.createElement('button');
                    closeButton.innerHTML = '&times;';
                    closeButton.className = 'btn btn-danger btn-sm position-absolute';
                    closeButton.style.top = '5px';
                    closeButton.style.right = '5px';
                    closeButton.addEventListener('click', function () {
                        container.removeChild(imgPlaceholder);

                        // Xóa file khỏi selectedFiles và cập nhật input
                        selectedFiles = selectedFiles.filter(f => f.name !== file.name);
                        updateImageInput();

                        // Kích hoạt lại nút nếu số ảnh < 4
                        if (selectedFiles.length < 4) {
                            document.getElementById('chooseImageButton').disabled = false;
                        }
                    });

                    imgPlaceholder.appendChild(closeButton);
                    container.appendChild(imgPlaceholder);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Hình ảnh này đã được chọn: ' + file.name);
            }
        } else {
            alert('Vui lòng chọn ảnh JPEG, PNG kích thước tối đa 1MB).');
        }
    }

    // Cập nhật input với danh sách file
    updateImageInput();

    // Kiểm tra nếu đã đủ 4 ảnh để vô hiệu hóa nút chọn
    document.getElementById('chooseImageButton').disabled = selectedFiles.length >= 4;
});

// Hàm cập nhật input với selectedFiles
function updateImageInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    imageInput.files = dataTransfer.files;

    // Cập nhật hidden input nếu cần
    imageNamesInput.value = selectedFiles.map(file => file.name).join(',');
}

// Hiển thị các size khi chọn màu
function showSizeOptions(color) {
    // Ẩn container của tất cả màu
    const allColorContainers = document.querySelectorAll('[id$="SizeContainer"]');
    allColorContainers.forEach(container => {
        container.style.display = 'none';
    });

    // Hiển thị container tương ứng với màu đã chọn
    const selectedColorContainer = document.getElementById(color + 'SizeContainer');
    selectedColorContainer.style.display = 'block';
}

// ===============================================

// Khởi tạo các nút màu và kích thước
const colorButtons = document.querySelectorAll('.color-button');
const sizeButtons = document.querySelectorAll('.size-button');
const sizeContainer = document.getElementById('sizeContainer');
const quantityInputs = document.getElementById('quantityInputs');

let selectedColorId = null;
let activeSizeId = null; // Kích thước hiện tại
let activeColors = {
    1: [],  // Đen
    2: [],  // Đỏ
    3: []   // Xám
};

let activeSizes = {
    XS: [],  // XS
    S: [],   // S
    M: [],   // M
    L: [],   // L
    XL: []   // XL
};

let savedQuantities = {}; // Đối tượng lưu trữ số lượng đã nhập
let savedPrices = {}; // Đối tượng lưu trữ giá đã nhập

// Cập nhật số lượng và giá đã nhập
const colorss = {
    1: 'den',
    2: 'do',
    3: 'xam'
};
// Xử lý click cho các nút màu
colorButtons.forEach(colorButton => {
    let clickCount = 0;
    let singleClickTimer;

    colorButton.addEventListener('click', () => {
        clickCount++;
        const colorId = colorButton.getAttribute('data-color-id');

        if (clickCount === 1) {
            // Set a timeout to handle single-click event
            singleClickTimer = setTimeout(() => {
                selectedColorId = colorId;

                // Hide all color groups and input fields
                document.querySelectorAll('#group-1').forEach(inputGroup => inputGroup.style.display = 'none');
                document.querySelectorAll('#group-2').forEach(inputGroup => inputGroup.style.display = 'none');
                document.querySelectorAll('#group-3').forEach(inputGroup => inputGroup.style.display = 'none');



                // document.querySelectorAll('#group-3').forEach(inputGroup => inputGroup.style.display = 'none');
                document.querySelectorAll(`#group-${selectedColorId}`).forEach(inputGroup => inputGroup.style.display = 'block');

                clickCount = 0; // Reset click count
            }, 300);
        } else if (clickCount === 2) {
            // Handle double-click event
            clearTimeout(singleClickTimer);
            document.querySelectorAll(`#group-${selectedColorId}`).forEach(inputGroup => inputGroup.style.display = 'block');
            // Toggle active state for the color button
            colorButton.classList.toggle('active');
            selectedColorId = colorId;

            // Update activeColors array for the selected color
            if (colorButton.classList.contains('active')) {
                activeColors[colorId] = Array.from(document.querySelectorAll(`.size-button[data-color-id="${colorId}"]`))
                    .filter(sizeButton => sizeButton.classList.contains('active'))
                    .map(sizeButton => sizeButton.getAttribute('data-size-id'));

        

            } else {
                activeColors[colorId] = [];
            document.querySelectorAll(`#group-${selectedColorId}`).forEach(inputGroup => inputGroup.style.display = 'none');
            document.querySelectorAll(`#${colorss[colorId]}SizeContainer`).forEach(inputGroup => inputGroup.style.display = 'none');
            

            }

            // Update the hidden input with active color-size combinations
            updateHiddenInputs();
            clickCount = 0; // Reset click count
        }
    });
});

// Handling size button clicks
sizeButtons.forEach(sizeButton => {
    let clickCount = 0;
    let singleClickTimer;

    sizeButton.addEventListener('click', () => {
        clickCount++;

        const sizeId = sizeButton.getAttribute('data-size-id');

        if (clickCount === 1) {
            // Set a timeout to handle single-click event
            singleClickTimer = setTimeout(() => {
                if (selectedColorId) { // Ensure a color is selected
                    activeSizeId = sizeId;

                    // Hide all input groups
                    document.querySelectorAll(`#group-${selectedColorId}`).forEach(inputGroup => inputGroup.style.display = 'block');

                    // Show the input group corresponding to the selected color and size
                    const key = `${selectedColorId}-${activeSizeId}`;
                    const inputGroup = document.getElementById(`input-${key}`);
                   
                    inputGroup.style.display = 'block';
                    
                }
                clickCount = 0; // Reset click count
            }, 300);
        } else if (clickCount === 2) {
            // Handle double-click event
            clearTimeout(singleClickTimer);
            document.querySelectorAll(`#group-${selectedColorId}`).forEach(inputGroup => inputGroup.style.display = 'block');
            // Toggle active state for the size button
            sizeButton.classList.toggle('active');
            activeSizeId = sizeId;

            const key = `${selectedColorId}-${activeSizeId}`;
            const inputGroup = document.getElementById(`input-${key}`);

            if (inputGroup) {
                inputGroup.style.display = 'block';
            }

            const colorId = selectedColorId;
            if (sizeButton.classList.contains('active')) {
                // Ensure the size is stored under the correct color
                if (!activeColors[colorId]) {
                    activeColors[colorId] = [];
                }
                activeColors[colorId].push(sizeId);
                
            } else {
                // Remove the size from the active list
               
                    const inputGroup = document.getElementById(`input-${key}`);
                    inputGroup.style.display = 'none';
                    activeColors[colorId] = Array.from(document.querySelectorAll(`.size-button[data-color-id="${colorId}"]`))
                    .filter(sizeButton => sizeButton.classList.contains('active'))
                    .map(sizeButton => sizeButton.getAttribute('data-size-id'));
                
            }

            // Update the hidden input with active color-size combinations
            updateHiddenInputs();

            clickCount = 0; // Reset click count
        }
    });
});







// Function to update the hidden inputs with the active color-size combinations
function updateHiddenInputs() {
    // Initialize an empty array to store the active color-size combinations
    let activeCombinations = [];

    // Loop through each active color
    Object.keys(activeColors).forEach(colorId => {
        // Loop through each size that is selected for this color
        activeColors[colorId].forEach(sizeId => {
            // Add the color-size combination (e.g., "1:1", "1:2") to the array
            activeCombinations.push(`${colorId}:${sizeId}`);
        });
    });

    // Join the combinations with commas and update the hidden input value
    document.getElementById('activeColors').value = activeCombinations.join(',');
}



// Hàm kiểm tra dữ liệu của các trường hợp màu và kích thước// Function to validate the form data
// Mảng màu
const colors = {
    1: 'Đen',
    2: 'Đỏ',
    3: 'Xám'
};

// Mảng kích thước
const sizes = {
    1: 'XS',
    2: 'S',
    3: 'M',
    4: 'L',
    5: 'XL'
};

// Hàm kiểm tra dữ liệu của các trường hợp màu và kích thước
function validateData() {
    let isValid = true;
    const errorMessageClass = 'input-error'; // Class for error messages

    // Hide any existing error messages
    document.querySelectorAll(`.${errorMessageClass}`).forEach(error => {
        error.remove();
    });

    // Iterate over each color and size combination
    Object.keys(activeColors).forEach(colorId => {
        activeColors[colorId].forEach(sizeId => {
            const colorName = colors[colorId]; // Get the color name based on ID
            const sizeName = sizes[sizeId]; // Get the size name based on ID

            // Create the key in the format 'Color-Size' (e.g., 'Đen-XS')
            const key = `${colorName}-${sizeName}`;

            // Get the quantity and price inputs by name
            const quantityInput = document.querySelector(`input[name="quantities[${key}]"]`);
            const priceInput = document.querySelector(`input[name="prices[${key}]"]`);

            // Validate quantity and price inputs
            if (!quantityInput || !quantityInput.value.trim()) {
                isValid = false;
                showError(quantityInput, 'Số lượng không được để trống.');
            }
            if (!priceInput || !priceInput.value.trim()) {
                isValid = false;
                showError(priceInput, 'Giá không được để trống.');
            }
        });
    });

    return isValid;
}

// Function to show error message under the input field
function showError(inputElement, message) {
    const errorElement = document.createElement('div');
    errorElement.className = 'text-danger ' + 'input-error';
    errorElement.textContent = message;

    // Append the error message under the input field
    inputElement.parentElement.appendChild(errorElement);
}


// Attach event listener to the form's submit event
document.querySelector('#addForm').addEventListener('submit', function(event) {
    if (!validateData()) {
        event.preventDefault(); // Prevent form submission if validation fails
        alert('Vui lòng kiểm tra các trường dữ liệu!');
    }
});





