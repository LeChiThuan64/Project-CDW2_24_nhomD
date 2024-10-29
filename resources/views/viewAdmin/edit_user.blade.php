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
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input id="username" name="name" type="text" value="{{ old('name', $user->name) }}" />
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" />
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input id="phone" name="phone" type="text" value="{{ old('phone', $user->phone) }}" />
            </div>
            <div class="form-group">
                <label>Giới tính</label>
                <div class="radio-group">
                    <label><input name="gender" type="radio" value="male" {{ $user->gender === 'male' ? 'checked' : '' }} /> Nam</label>
                    <label><input name="gender" type="radio" value="female" {{ $user->gender === 'female' ? 'checked' : '' }} /> Nữ</label>
                    <label><input name="gender" type="radio" value="other" {{ $user->gender === 'other' ? 'checked' : '' }} /> Khác</label>
                </div>
            </div>
            <div class="form-group">
                <label for="dob">Ngày sinh</label>
                <input id="dob" name="dob" type="date" value="{{ old('dob', $user->dob ? $user->dob->format('Y-m-d') : '') }}" />
            </div>

            <div class="profile-pic">
                <img id="profileImage" alt="ảnh" src="{{ $user->profile_image ? asset($user->profile_image) : 'https://storage.googleapis.com/a1aa/image/JvrL8IccnN7JEFHYrd8lG4Pkxxr1MJyu5roHmDKfPBx2sy1JA.jpg' }}" />
                <input id="uploadImage" name="profile_image" type="file" accept="image/*" onchange="previewImage(event)" style="display: none;" />
                <label for="uploadImage" class="upload-button">Chọn ảnh</label>
                <div class="file-info">Dung lượng file tối đa 1 MB<br />Định dạng: JPEG, PNG</div>
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <a href="{{ route('tables') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </form>

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