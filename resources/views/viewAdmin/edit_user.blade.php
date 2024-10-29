@extends('viewAdmin.navigation')

@section('title', 'Edit Blog')

@section('content')
<html>

<head>
    <title>Sửa User</title>
    <link rel="stylesheet" href="{{ asset('assets/css/edit_user.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="header">Sửa User</div>
        <div class="sub-header">Quản lý thông tin hồ sơ để bảo mật tài khoản</div>
        <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input id="username" placeholder="tên tài khoản" type="text" />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" />
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input id="phone" type="text" />
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <div class="password-wrapper">
                <input id="password" type="password" />
                <i id="togglePassword" class="fas fa-eye"></i>
            </div>
        </div>

        <div class="form-group">
            <label>Giới tính</label>
            <div class="radio-group">
                <label><input name="gender" type="radio" value="male" /> Nam</label>
                <label><input name="gender" type="radio" value="female" /> Nữ</label>
                <label><input name="gender" type="radio" value="other" />
                    Khác
                </label>
            </div>
        </div>
        <div class="form-group">
            <label for="dob">Ngày sinh</label>
            <input id="dob" type="date" />
            <span class="calendar-icon"></span>
        </div>
        <div class="buttons">
            <input type="button" value="Lưu" />
            <input type="button" value="Hủy" />
        </div>
        <div class="profile-pic">
            <img id="profileImage" alt="ảnh" src="https://storage.googleapis.com/a1aa/image/JvrL8IccnN7JEFHYrd8lG4Pkxxr1MJyu5roHmDKfPBx2sy1JA.jpg" />
            <input id="uploadImage" type="file" accept="image/*" onchange="previewImage(event)" style="display: none;" />
            <label for="uploadImage" class="upload-button">Chọn ảnh</label>
            <div class="file-info">Dung lượng file tối đa 1 MB<br />Định dạng: JPEG, PNG</div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // Toggle the password field type between password and text
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Toggle the eye icon between eye and eye-slash
            this.classList.toggle("fa-eye");
            this.classList.toggle("fa-eye-slash");
        });

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>

</html>
@endsection