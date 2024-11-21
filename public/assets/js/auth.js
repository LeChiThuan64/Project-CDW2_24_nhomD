document.addEventListener("DOMContentLoaded", function () {
    // Xử lý submit cho form đăng nhập
    const loginForm = document.getElementById('login-form');

    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Xóa lỗi cũ
            document.getElementById('login-email-error').innerHTML = '';
            document.getElementById('login-password-error').innerHTML = '';
            document.getElementById('login-error').innerHTML = '';

            let formData = new FormData(this);

            fetch(loginUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        // Xử lý lỗi cụ thể cho từng trường
                        if (data.errors) {
                            for (const [key, messages] of Object.entries(data.errors)) {
                                const errorSpan = document.getElementById(`login-${key}-error`);
                                if (errorSpan) {
                                    errorSpan.innerHTML = messages.join('<br>'); // Hiển thị lỗi
                                }
                            }
                        } else {
                            // Hiển thị lỗi tổng quát
                            document.getElementById('login-error').innerHTML = data.message;
                        }
                    } else if (data.status === 'success') {
                        // Chuyển hướng nếu đăng nhập thành công
                        window.location.href = data.redirect;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }





    // Xử lý submit cho form đăng ký
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();

            // Xóa lỗi cũ
            document.getElementById('name-error').innerHTML = '';
            document.getElementById('email-error').innerHTML = '';
            document.getElementById('password-error').innerHTML = '';
            document.getElementById('password_confirmation-error').innerHTML = '';
            document.getElementById('register-error').innerHTML = '';

            // Lấy dữ liệu từ form
            let formData = new FormData(this);

            // Gửi yêu cầu đăng ký
            fetch(registerUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'error') {
                        if (data.errors) {
                            // Hiển thị lỗi xác thực từng trường
                            for (const [key, messages] of Object.entries(data.errors)) {
                                const errorSpan = document.getElementById(`${key}-error`);
                                if (errorSpan) {
                                    errorSpan.innerHTML = messages.join('<br>'); // Gộp lỗi bằng <br>
                                }
                            }
                        }
                    } else if (data.status === 'success') {
                        // alert(data.message);
                        window.location.href = "#";
                        // Xóa dữ liệu trong form
                        registerForm.reset();
                        let statusMessage = data.message;
                        let type = 'info'; // Bạn có thể thay đổi type nếu cần (error, warning, info)
                        createToast(type, 'fa-solid fa-circle-check', 'Success', statusMessage);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }

});
