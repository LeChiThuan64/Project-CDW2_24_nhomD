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
    setTimeout(function() {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            successMessage.style.transition = 'opacity 0.5s';
            successMessage.style.opacity = 0; // Giảm độ sáng
            setTimeout(function() {
                successMessage.style.display = 'none'; // Ẩn thông báo
            }, 500); // Chờ cho đến khi hoàn thành hiệu ứng giảm sáng
        }
    }, 1500); // 3 giây
    
});

// Function to handle image input
document.getElementById('chooseImageButton').addEventListener('click', function(event) {
    event.preventDefault(); // Ngăn chặn form submit
    document.getElementById('imageInput').click();
});

document.getElementById('imageInput').addEventListener('change', function(event) {
    const files = event.target.files; // Get selected files
    const container = document.getElementById('imagePlaceholderContainer');
    const imageNamesInput = document.getElementById('imageNames');
    let imageNames = imageNamesInput.value ? imageNamesInput.value.split(',') : []; // Keep track of image names

    // Check current number of images and disable the button if 4 images are selected
    if (imageNames.length >= 4) {
        document.getElementById('chooseImageButton').disabled = true; // Disable button if 4 images selected
        return; // Stop if already selected 4 images
    }

    // Loop through selected files
    for (let i = 0; i < files.length; i++) {
        // Check again before adding images
        if (imageNames.length >= 4) break; // Stop if already at 4 images

        const file = files[i];

        // Add image name to the array
        imageNames.push(file.name); // Save image name to array

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'img-thumbnail w-100'; // Add Bootstrap class for thumbnail

            const imgPlaceholder = document.createElement('div');
            imgPlaceholder.className = 'image-placeholder'; // Add class for image placeholder
            imgPlaceholder.appendChild(img);

            // Add remove functionality
            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;';
            closeButton.className = 'btn btn-danger btn-sm position-absolute'; // Bootstrap position
            closeButton.style.top = '5px';
            closeButton.style.right = '5px';
            closeButton.addEventListener('click', function() {
                container.removeChild(imgPlaceholder);
                imageNames.splice(imageNames.indexOf(file.name), 1); // Remove image name from array
                imageNamesInput.value = imageNames.join(','); // Update hidden field with new image names

                // Re-enable the button if number of images drops below 4
                if (imageNames.length < 4) {
                    document.getElementById('chooseImageButton').disabled = false; // Re-enable button
                }
            });

            imgPlaceholder.appendChild(closeButton);
            container.appendChild(imgPlaceholder);
        };

        // **Add file to the input**
        let dataTransfer = new DataTransfer(); // Use DataTransfer to handle multiple files
        for (let j = 0; j < files.length; j++) {
            dataTransfer.items.add(files[j]); // Add files to DataTransfer
        }
        document.getElementById('imageInput').files = dataTransfer.files; // Update input files

        reader.readAsDataURL(file);
    }

    imageNamesInput.value = imageNames.join(','); // Assign image names to hidden input
    console.log("Selected images:", imageNamesInput.value); // Log selected images
});





// Sửa Lý =============================================================================

const colorButtons = document.querySelectorAll('.color-button');
const sizeButtons = document.querySelectorAll('.size-button');
const sizeContainer = document.getElementById('sizeContainer');
const quantityInputs = document.getElementById('quantityInputs');

let selectedColorId = null;
let activeColors = new Set(); // Tập hợp các màu được active
let activeSizeId = null; // Kích thước hiện tại
let activeSizes = {}; // Đối tượng lưu trữ các kích thước active theo màu

let savedQuantities = {}; // Đối tượng lưu trữ số lượng đã nhập
let savedPrices = {}; // Đối tượng lưu trữ giá đã nhập

// Cập nhật số lượng và giá đã nhập
function updateSavedInputs(key) {
    const quantityInput = document.querySelector(`input[name="quantities[${key}]"]`);
    const priceInput = document.querySelector(`input[name="prices[${key}]"]`);

    if (quantityInput) {
        savedQuantities[key] = quantityInput.value;
    }
    if (priceInput) {
        savedPrices[key] = priceInput.value;
    }
}

quantityInputs.addEventListener('input', function(event) {
    const key = event.target.name.split('[')[1].split(']')[0]; // Lấy key từ name
    updateSavedInputs(key); // Cập nhật thông tin đã lưu
});

// Cập nhật ô nhập liệu
// Cập nhật ô nhập liệu
function updateQuantityInput() {
    quantityInputs.innerHTML = ''; // Xóa tất cả ô nhập liệu hiện tại

    // Chỉ hiển thị ô nhập liệu nếu có màu và kích thước đã chọn
    if (selectedColorId && activeSizeId) {
        const key = `${selectedColorId}-${activeSizeId}`;
        const inputGroup = document.createElement('div');
        inputGroup.classList.add('row', 'mb-2');
        inputGroup.id = key.replace('-', '_');

        const quantityValue = savedQuantities[key] || 0; // Lấy số lượng đã lưu hoặc mặc định là 0
        const priceValue = savedPrices[key] || 0; // Lấy giá đã lưu hoặc mặc định là 0

        inputGroup.innerHTML = `
            <div class="col-6">
                <label>Số lượng (${selectedColorId} - ${activeSizeId})</label>
                <input type="number" name="quantities[${key}]" class="form-control" placeholder="Số lượng" min="0" value="${quantityValue}">
            </div>
            <div class="col-6">
                <label>Giá (${selectedColorId} - ${activeSizeId})</label>
                <input type="number" name="prices[${key}]" class="form-control" placeholder="Giá" min="0" value="${priceValue}">
            </div>
        `;
        
        quantityInputs.appendChild(inputGroup); // Thêm ô nhập liệu mới

        // Thêm sự kiện cho ô nhập liệu
        const quantityInput = inputGroup.querySelector(`input[name="quantities[${key}]"]`);
        const priceInput = inputGroup.querySelector(`input[name="prices[${key}]"]`);

        // Gọi hàm khi có sự thay đổi giá trị trong ô nhập liệu
        quantityInput.addEventListener('input', function() {
            const quantity = quantityInput.value;
            const price = priceInput.value;
            onInputUpdate(selectedColorId, activeSizeId, quantity, price); // Cập nhật thông tin vào hidden inputs
        });

        priceInput.addEventListener('input', function() {
            const quantity = quantityInput.value;
            const price = priceInput.value;
            onInputUpdate(selectedColorId, activeSizeId, quantity, price); // Cập nhật thông tin vào hidden inputs
        });
    }
}


// Xử lý click cho các nút màu
colorButtons.forEach(colorButton => {
    let clickCount = 0;

    colorButton.addEventListener('click', () => {
        clickCount++;
        const colorId = colorButton.getAttribute('data-color-id');

        setTimeout(() => {
            if (clickCount === 1) {
                // Chọn màu và hiển thị các kích thước
                selectedColorId = colorId;
                sizeContainer.style.display = 'block';

                // Xóa các kích thước đã active và ô nhập liệu trước đó
                sizeButtons.forEach(btn => {
                    btn.classList.remove('active'); // Xóa lớp active từ tất cả
                    if (activeSizes[colorId] && activeSizes[colorId].has(btn.getAttribute('data-size-id'))) {
                        btn.classList.add('active'); // Giữ lại lớp active cho kích thước đã chọn
                    }
                });

                // Cập nhật kích thước hiện tại
                activeSizeId = activeSizes[colorId] ? Array.from(activeSizes[colorId])[0] : null;
                updateQuantityInput(); // Cập nhật ô nhập liệu nếu có kích thước active
            } else if (clickCount === 2) {
                // Double click để toggle active màu
                if (activeColors.has(colorId)) {
                    activeColors.delete(colorId);
                    colorButton.classList.remove('active');
                } else {
                    activeColors.add(colorId);
                    colorButton.classList.add('active');
                }
            }

            // Thêm class click cho màu được chọn
            colorButtons.forEach(btn => {
                if (btn !== colorButton) {
                    btn.classList.remove('click'); // Xóa click từ nút màu khác
                } else {
                    btn.classList.add('click'); // Thêm click cho nút màu hiện tại
                }
            });

            clickCount = 0;
        }, 250);
    });
});

// Xử lý click cho các nút kích thước
sizeButtons.forEach(sizeButton => {
    let clickCount = 0;

    sizeButton.addEventListener('click', () => {
        clickCount++;
        const sizeId = sizeButton.getAttribute('data-size-id');

        setTimeout(() => {
            if (clickCount === 1) {
                // Chọn kích thước và cập nhật ô nhập liệu
                if (selectedColorId) { // Kiểm tra xem đã chọn màu chưa
                    if (activeSizeId === sizeId) {
                        activeSizeId = null; // Hủy kích thước nếu đã active
                        sizeButton.classList.remove('active');
                        quantityInputs.innerHTML = ''; // Xóa ô nhập liệu
                        // Xóa kích thước khỏi activeSizes
                        if (activeSizes[selectedColorId]) {
                            activeSizes[selectedColorId].delete(sizeId);
                        }
                    } else {
                        activeSizeId = sizeId; // Cập nhật kích thước đã active
                        // Lưu kích thước vào activeSizes
                        if (!activeSizes[selectedColorId]) {
                            activeSizes[selectedColorId] = new Set();
                        }
                        activeSizes[selectedColorId].add(sizeId);
                        updateQuantityInput(); // Cập nhật ô nhập liệu
                    }
                }
            } else if (clickCount === 2) {
                // Double click để toggle active kích thước
                sizeButton.classList.toggle('active');
                if (activeSizes[selectedColorId]) {
                    if (activeSizes[selectedColorId].has(sizeId)) {
                        activeSizes[selectedColorId].delete(sizeId);
                    } else {
                        activeSizes[selectedColorId].add(sizeId);
                    }
                } else {
                    activeSizes[selectedColorId] = new Set([sizeId]);
                }
                updateQuantityInput(); // Cập nhật ô nhập liệu
            }

            clickCount = 0;
        }, 250);
    });
});


// Thu thập dữ liệu để gửi đến server
function collectDataForSubmission() {
    const data = [];

    activeColors.forEach(colorId => {
        if (activeSizes[colorId]) {
            activeSizes[colorId].forEach(sizeId => {
                const key = `${colorId}-${sizeId}`;
                const quantity = savedQuantities[key] || 0; // Hoặc giá trị mặc định
                const price = savedPrices[key] || 0; // Hoặc giá trị mặc định

                data.push({
                    colorId: colorId,
                    sizeId: sizeId,
                    quantity: quantity,
                    price: price
                });
            });
        }
    });

    return data; // Trả về mảng chứa dữ liệu đã thu thập
}


// Gửi dữ liệu đến server
function sendDataToServer(data) {
    // Cập nhật hidden inputs cho mỗi mục trong data
    data.forEach(item => {
        addOrUpdateHiddenInput(item.colorId, item.sizeId, item.quantity, item.price);
    });

    return fetch('/products/store', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(result => {
        console.log('Success:', result);
    })
    .catch(error => {
        console.error('Error:', error);
        throw error; // Re-throw error to handle in form submission
    });
}




// Function to update or add hidden inputs to the form
function addOrUpdateHiddenInput(colorId, sizeId, quantity, price) {
    const form = document.querySelector('form');
    const key = `${colorId}-${sizeId}`;
    
    // Check if hidden inputs already exist for this key, if not, create them
    let quantityInput = document.querySelector(`input[name="quantities[${key}]"]`);
    let priceInput = document.querySelector(`input[name="prices[${key}]"]`);

    if (!quantityInput) {
        quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = `quantities[${key}]`;
        form.appendChild(quantityInput);
    }
    if (!priceInput) {
        priceInput = document.createElement('input');
        priceInput.type = 'hidden';
        priceInput.name = `prices[${key}]`;
        form.appendChild(priceInput);
    }

    // Set values
    quantityInput.value = quantity;
    priceInput.value = price;
}

// Call this function whenever the user enters data for quantity or price
function onInputUpdate(colorId, sizeId, quantity, price) {
    addOrUpdateHiddenInput(colorId, sizeId, quantity, price);
}
