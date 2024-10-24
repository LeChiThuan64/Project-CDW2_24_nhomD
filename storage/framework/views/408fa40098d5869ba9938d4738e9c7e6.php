<?php $__env->startSection('title', 'Tables'); ?>

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }
        .valid-feedback {
            display: none;
            color: green;
        }
        .is-valid ~ .valid-feedback {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Thêm User</h1>
        <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
        
        <!-- Form để thêm người dùng -->
        <form id="userForm" action="<?php echo e(route('user.store')); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>  <!-- Bảo vệ CSRF token -->

            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="name"  required>
                <div class="invalid-feedback">
                    Tên đăng nhập không được để trống.
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback" id="email-error">
                    Email không hợp lệ. Ví dụ: example@domain.com.
                </div>
                <div class="valid-feedback">
                    Email hợp lệ.
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback" id="password-error">
                    Mật khẩu phải từ 5 đến 10 ký tự, bao gồm ít nhất 1 chữ thường, 1 chữ HOA, 1 số và 1 ký tự đặc biệt.
                </div>
                <div class="valid-feedback">
                    Mật khẩu hợp lệ.
                </div>
            </div>
            
            <div class="buttons">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-danger" onclick="window.history.back();">Hủy</button> <!-- Nút hủy quay lại trang trước -->
            </div>
        </form>
    </div>

    <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            // Lấy các input
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            let valid = true;

            // Kiểm tra email bằng regex
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!email.value.match(emailPattern)) {
                email.classList.add('is-invalid');
                email.classList.remove('is-valid');
                valid = false;
            } else {
                email.classList.add('is-valid');
                email.classList.remove('is-invalid');
            }

            // Kiểm tra mật khẩu bằng regex
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{5,10}$/;
            if (!password.value.match(passwordPattern)) {
                password.classList.add('is-invalid');
                password.classList.remove('is-valid');
                valid = false;
            } else {
                password.classList.add('is-valid');
                password.classList.remove('is-invalid');
            }

            // Nếu không hợp lệ, ngăn chặn submit form
            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('viewAdmin.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Project-CDW2_24_nhomD\resources\views/viewAdmin/addUser.blade.php ENDPATH**/ ?>