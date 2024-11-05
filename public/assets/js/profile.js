document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector('a[href="#accountCollapse"]');
    const collapseDiv = document.getElementById("accountCollapse");

    // Đảm bảo collapseDiv không có class show khi tải trang
    collapseDiv.classList.remove("show");
    collapseDiv.style.maxHeight = "0";
    collapseDiv.style.opacity = "0";

    toggleButton.addEventListener("click", function (event) {
        event.preventDefault();
        if (collapseDiv.classList.contains("show")) {
            collapseDiv.style.maxHeight = "0"; // Thu gọn
            collapseDiv.style.opacity = "0"; // Đặt opacity về 0
            setTimeout(() => collapseDiv.classList.remove("show"), 500);
        } else {
            collapseDiv.classList.add("show");
            collapseDiv.style.maxHeight = collapseDiv.scrollHeight + "px"; // Mở rộng
            collapseDiv.style.opacity = "1"; // Đặt opacity về 1
        }
    });

    const daySelect = document.getElementById("day");
    const monthSelect = document.getElementById("month");
    const yearSelect = document.getElementById("year");

    // Thêm tùy chọn cho ngày
    for (let i = 1; i <= 31; i++) {
        daySelect.innerHTML += `<option value="${i}">${i}</option>`;
    }

    // Thêm tùy chọn cho tháng
    for (let i = 1; i <= 12; i++) {
        monthSelect.innerHTML += `<option value="${i}">Tháng ${i}</option>`;
    }

    // Thêm tùy chọn cho năm (từ 1950 đến 2024)
    for (let i = 1950; i <= 2024; i++) {
        yearSelect.innerHTML += `<option value="${i}">${i}</option>`;
    }

    // Lấy tất cả các trường có thể chỉnh sửa trong biểu mẫu
    const inputs = document.querySelectorAll('#username, #email, #phone, input[name="gender"], #day, #month, #year');
    const saveButton = document.getElementById('saveButton');
    const originalValues = {};

    // Lưu giá trị ban đầu của các trường để so sánh
    inputs.forEach(input => {
        if (input.type === 'radio') {
            originalValues[input.name] = document.querySelector(`input[name="${input.name}"]:checked`)?.value || '';
        } else {
            originalValues[input.id] = input.value;
        }

        // Lắng nghe sự thay đổi của mỗi trường
        input.addEventListener('input', checkChanges);
        input.addEventListener('change', checkChanges);
    });

    // Hàm kiểm tra sự thay đổi trong các trường
    function checkChanges() {
        let hasChanges = false;

        // Kiểm tra từng trường và so sánh với giá trị ban đầu
        inputs.forEach(input => {
            if (input.type === 'radio') {
                if (document.querySelector(`input[name="${input.name}"]:checked`)?.value !== originalValues[input.name]) {
                    hasChanges = true;
                }
            } else {
                if (input.value !== originalValues[input.id]) {
                    hasChanges = true;
                }
            }
        });

        // Kích hoạt hoặc vô hiệu hóa nút "Lưu" dựa trên sự thay đổi
        saveButton.disabled = !hasChanges;
    }

    const profileImage = document.getElementById('profileImage');
    const imageUpload = document.getElementById('imageUpload');
    const chooseImageButton = document.getElementById('chooseImageButton');

    // Lưu trữ URL hiện tại của hình ảnh
    const currentImageURL = profileImage.src;

    chooseImageButton.addEventListener('click', function() {
        imageUpload.click(); // Kích hoạt thẻ input file
    });

    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0]; // Lấy tệp được chọn
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Cập nhật src của img với ảnh mới được chọn
                profileImage.src = e.target.result;

                // Kích hoạt nút "Lưu" nếu hình ảnh mới khác với hình ảnh hiện tại
                saveButton.disabled = e.target.result === currentImageURL; // Kích hoạt hoặc vô hiệu hóa nút "Lưu"
            };
            reader.readAsDataURL(file); // Đọc tệp như URL
        }
    });
});


 // Kiểm tra xem có thông báo thành công không
 window.onload = function() {
    var successMessage = document.getElementById('successMessage');
    if (successMessage) {
        // Ẩn thông báo sau 2 giây
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 2000); // 2000 milliseconds = 2 seconds
    }
};