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

    // Gọi checkChanges khi trang tải để đặt trạng thái của nút "Lưu"
    checkChanges();

    const profileImage = document.getElementById('profileImage');
    const imageUpload = document.getElementById('imageUpload');
    const chooseImageButton = document.getElementById('chooseImageButton');

    chooseImageButton.addEventListener('click', function() {
        imageUpload.click(); // Kích hoạt thẻ input file
    });

    imageUpload.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const maxSizeInMB = 1; // Giới hạn dung lượng tối đa 1 MB
            const maxSizeInBytes = maxSizeInMB * 1024 * 1024; // Chuyển đổi MB sang Bytes
            const validTypes = ['image/jpeg', 'image/png'];

            // Kiểm tra loại file
            if (!validTypes.includes(file.type)) {
                alert('Vui lòng chọn file định dạng JPG hoặc PNG.');
                this.value = ''; // Xóa giá trị input
                return;
            }

            // Kiểm tra dung lượng file
            if (file.size > maxSizeInBytes) {
                alert('Dung lượng file không được vượt quá 1 MB.');
                this.value = ''; // Xóa giá trị input
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
                saveButton.disabled = false; // Bật nút lưu vì đã có thay đổi
            };
            reader.readAsDataURL(file);
        }
    });

    // Kiểm tra xem có thông báo thành công không
    window.onload = function() {
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 2000); // 2000 milliseconds = 2 seconds
        }
    };

    document.getElementById('profileForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Clear previous error messages
        document.getElementById('usernameError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('phoneError').textContent = '';
        
        let hasError = false;

        // Validate Username
        const username = document.getElementById('username').value;
        if (username.length < 3 || username.length > 50) {
            document.getElementById('usernameError').textContent = 'Tên tài khoản phải có độ dài từ 3 đến 255 ký tự.';
            hasError = true;
        }

        // Validate Email
        const email = document.getElementById('email').value;
        const emailPattern = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
        if (!emailPattern.test(email)) {
            document.getElementById('emailError').textContent = 'Email không hợp lệ.';
            hasError = true;
        }

        // Validate Phone
        const phone = document.getElementById('phone').value;
        const phonePattern = /^(0[1-9])[0-9]{8,9}$/; // Matches numbers starting with '0' and has 10-11 digits
        if (!phonePattern.test(phone)) {
            document.getElementById('phoneError').textContent = 'Số điện thoại không hợp lệ. Chỉ cho phép số và tối đa 11 chữ số.';
            hasError = true;
        }

        // Submit the form if no validation errors
        if (!hasError) {
            this.submit();
        }
    });
});
