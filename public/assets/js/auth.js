document.addEventListener("DOMContentLoaded", function() {
    const loginTab = document.getElementById('login-tab');
    const registerTab = document.getElementById('register-tab');
    const loginContainer = document.getElementById('login-container');
    const registerContainer = document.getElementById('register-container');

    // Điều hướng giữa các tab
    loginTab.addEventListener('click', function() {
        loginTab.classList.add('active');
        registerTab.classList.remove('active');
        registerContainer.classList.remove('active');
        setTimeout(() => {
            registerContainer.style.display = "none";
            loginContainer.style.display = "block";
            loginContainer.classList.add('active');
        }, 400);
    });

    registerTab.addEventListener('click', function() {
        registerTab.classList.add('active');
        loginTab.classList.remove('active');
        loginContainer.classList.remove('active');
        setTimeout(() => {
            loginContainer.style.display = "none";
            registerContainer.style.display = "block";
            registerContainer.classList.add('active');
        }, 400);
    });

    // Xử lý submit cho form đăng nhập
    const loginForm = document.getElementById('login-form');
    
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
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
                    if (data.errors) {
                        for (const [key, messages] of Object.entries(data.errors)) {
                            const errorSpan = document.getElementById(`${key}-error`);
                            if (errorSpan) {
                                errorSpan.innerHTML = messages.join('<br>');
                            }
                        }
                    } else {
                        document.getElementById('login-error').innerHTML = data.message;
                    }
                } else if (data.status === 'success') {
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
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Kiểm tra dữ liệu form trước khi gửi
            let formData = new FormData(this);
            console.log("Form data gửi đi:", Object.fromEntries(formData.entries())); // In dữ liệu form để kiểm tra

            fetch(registerUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => {
                console.log("Response status:", response.status); // Kiểm tra status
                if (!response.ok) {
                    console.error('Lỗi phản hồi từ server:', response);
                }
                return response.json();
            })
            .then(data => {
                console.log("Dữ liệu phản hồi từ server:", data); // Kiểm tra dữ liệu phản hồi
            
                if (data.status === 'error') {
                    if (data.errors) {
                        console.log("Lỗi xác thực:", data.errors); // In lỗi xác thực chi tiết
            
                        // Hiển thị lỗi xác thực trên giao diện
                        for (const [key, messages] of Object.entries(data.errors)) {
                            const errorSpan = document.getElementById(`${key}-error`);
                            if (errorSpan) {
                                errorSpan.innerHTML = messages.join('<br>');
                            }
                        }
                    }
                } else if (data.status === 'success') {
                    alert(data.message);
                    window.location.href = authUrl;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
