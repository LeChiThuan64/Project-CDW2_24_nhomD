<html>

<head>
    <title>Login and Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #fff;
        }

        .container {
            width: 400px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .tabs div {
            margin: 0 10px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            color: #666;
        }

        .tabs .active {
            font-weight: bold;
            color: #000;
            border-bottom: 2px solid #000;
        }

        .form-group input,
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-container .btn {
            width: 100%;
            padding: 15px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container .btn:hover {
            background-color: #555;
        }

        .form-text,
        .footer {
            font-size: 14px;
            color: #666;
            margin-top: 20px;
        }

        .footer a,
        .form-container a {
            color: #666;
            text-decoration: none;
        }

        .footer a:hover,
        .form-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="tabs">
            <div id="login-tab" class="{{ Request::is('login') ? 'active' : '' }}">LOGIN</div>
            <div id="register-tab" class="{{ Request::is('register') ? 'active' : '' }}">REGISTER</div>
        </div>

        @yield('content') <!-- Sử dụng yield để hiển thị nội dung đăng nhập hoặc đăng ký -->

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Điều hướng giữa các tab
            document.getElementById('login-tab').addEventListener('click', function() {
                window.location.href = "{{ route('login') }}"; // Điều hướng đến trang login
            });

            document.getElementById('register-tab').addEventListener('click', function() {
                window.location.href = "{{ route('register') }}"; // Điều hướng đến trang register
            });

            // Đăng nhập
            const loginForm = document.getElementById('login-form');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    // Xóa bỏ các lỗi trước khi gửi lại form
                    document.getElementById('email-error').textContent = '';
                    document.getElementById('password-error').textContent = '';
                    document.getElementById('login-error').textContent = '';

                    // Lấy dữ liệu form
                    let formData = new FormData(this);

                    // Gửi yêu cầu AJAX
                    fetch("{{ route('login') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.errors) {
                                // Nếu có lỗi, hiển thị dưới các input
                                if (data.errors.email) {
                                    document.getElementById('email-error').textContent = data.errors.email[0];
                                }
                                if (data.errors.password) {
                                    document.getElementById('password-error').textContent = data.errors.password[0];
                                }
                            } else if (data.status === 'error') {
                                // Nếu đăng nhập thất bại
                                document.getElementById('login-error').textContent = data.message;
                            } else {
                                // Nếu đăng nhập thành công, chuyển hướng đến trang dashboard
                                window.location.href = data.redirect;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('login-error').textContent = 'Lỗi hệ thống, vui lòng thử lại sau.';
                        });
                });
            }

            // Đăng ký
            const registerForm = document.getElementById('register-form');
            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    e.preventDefault(); // Ngăn trình duyệt gửi form theo cách thông thường

                    // Xóa các lỗi trước đó
                    document.getElementById('name-error').textContent = '';
                    document.getElementById('email-error').textContent = '';
                    document.getElementById('password-error').textContent = '';
                    document.getElementById('password-confirmation-error').textContent = '';
                    document.getElementById('register-error').textContent = '';

                    // Lấy dữ liệu form
                    let formData = new FormData(this);

                    // Gửi yêu cầu AJAX
                    fetch("{{ route('register') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.errors) {
                                // Hiển thị lỗi dưới mỗi trường input tương ứng
                                if (data.errors.name) {
                                    document.getElementById('name-error').textContent = data.errors.name[0];
                                }
                                if (data.errors.email) {
                                    document.getElementById('email-error').textContent = data.errors.email[0];
                                }
                                if (data.errors.password) {
                                    document.getElementById('password-error').textContent = data.errors.password[0];
                                }
                                if (data.errors.password_confirmation) {
                                    document.getElementById('password-confirmation-error').textContent = data.errors.password_confirmation[0];
                                }
                            } else if (data.status === 'error') {
                                // Xử lý các lỗi tổng quát khác
                                document.getElementById('register-error').textContent = data.message;
                            } else {
                                // Nếu đăng ký thành công, chuyển hướng người dùng
                                window.location.href = "{{ route('login') }}"; 
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('register-error').textContent = 'Lỗi hệ thống, vui lòng thử lại sau.';
                        });
                });
            }
        });
    </script>


</body>

</html>