@extends('viewAdmin.navigation')

@section('title', 'Tables')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/add_user.css') }}">
    <style>
      
    </style>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Thêm User</h1>
        <p class="text-center text-muted">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>

        <!-- Form để thêm người dùng -->
        <form id="userForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf <!-- Bảo vệ CSRF token -->

            <!-- <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control " id="username" name="name" required>
                <div class="invalid-feedback">Tên đăng nhập không được để trống.</div>
            </div> -->
            <div class="mb-3">
    <label for="username" class="form-label">Tên đăng nhập</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="username" name="name" value="{{ old('name') }}" required>
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <!-- <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">Email không hợp lệ. Ví dụ: example@domain.com.</div>
            </div> -->
            <div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <!-- <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div class="invalid-feedback" id="password-error">
                    Mật khẩu phải từ 5 đến 10 ký tự, bao gồm ít nhất 1 chữ thường, 1 chữ HOA, 1 số và 1 ký tự đặc biệt.
                </div>
                <div class="valid-feedback">
                    Mật khẩu hợp lệ.
                </div>
            </div> -->
            <div class="mb-3">
    <label for="password" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
    @error('password')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
            <!-- <div class="mb-3">
                <label for="phone" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone">
                <div class="invalid-feedback">Số điện thoại phải có 10 chữ số không được có khoảng trăng trước sau và chử ký tự bất kỳ.</div>
            </div> -->
            <div class="mb-3">
    <label for="phone" class="form-label">Số điện thoại</label>
    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
    <div class="invalid-feedback">Số điện thoại phải có 10 chữ số không được có khoảng trăng trước sau và chử ký tự bất kỳ.</div>

</div>
            <!-- <div class="form-group">
                <label class="form-label">Giới tính</label>
                <div>
                    <label><input name="gender" type="radio" value="male"> Nam</label>
                    <label><input name="gender" type="radio" value="female"> Nữ</label>
                    <label><input name="gender" type="radio" value="other"> Khác</label>
                </div>
            </div> -->
            <div class="form-group">
    <label class="form-label">Giới tính</label>
    <div>
        <label><input name="gender" type="radio" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}> Nam</label>
        <label><input name="gender" type="radio" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}> Nữ</label>
        <label><input name="gender" type="radio" value="other" {{ old('gender') == 'other' ? 'checked' : '' }}> Khác</label>
    </div>
    @error('gender')
    <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
            <div class="mb-3">
                <label for="dob" class="form-label">Ngày sinh</label>
                <input id="dob" name="dob" type="date" class="form-control">
            </div>

            <div class="profile-pic">
                <img id="profileImage" alt="Ảnh đại diện" src="https://storage.googleapis.com/a1aa/image/JvrL8IccnN7JEFHYrd8lG4Pkxxr1MJyu5roHmDKfPBx2sy1JA.jpg" />
                <input id="uploadImage" type="file" name="profile_image" accept="image/*" onchange="previewImage(event)">
                <label for="uploadImage" class="upload-button">Chọn ảnh</label>
                <div class="file-info">Dung lượng file tối đa 1 MB<br>Định dạng: JPEG, PNG</div>
            </div>

            <div class="buttons">
                <button type="submit" class="btn btn-primary">Lưu</button>
                <button type="button" class="btn btn-danger" onclick="window.history.back();">Hủy</button>
            </div>
        </form>
    </div>

    <script>
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

        document.getElementById('userForm').addEventListener('submit', function(event) {
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const phone = document.getElementById('phone');
            let valid = true;

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!email.value.match(emailPattern)) {
                email.classList.add('is-invalid');
                valid = false;
            } else {
                email.classList.remove('is-invalid');
                email.classList.add('is-valid');
            }

            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{5,10}$/;
            if (!password.value.match(passwordPattern)) {
                password.classList.add('is-invalid');
                valid = false;
            } else {
                password.classList.remove('is-invalid');
                password.classList.add('is-valid');
            }

            const phonePattern = /^[0-9]{10}$/;
            if (!phone.value.match(phonePattern)) {
                phone.classList.add('is-invalid');
                valid = false;
            } else {
                phone.classList.remove('is-invalid');
                phone.classList.add('is-valid');
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection