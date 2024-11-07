@extends('viewUser.navigation_profile')
@section('title', 'Profile')
@section('contentProfile')

@if (session('success'))
    <div class="alert alert-success" id="successMessage">
        {{ session('success') }}
    </div>
@endif

<div class="profile-section">
    <h5>Hồ Sơ Của Tôi</h5>
    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>

    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="profileForm">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col-md-8">
            <div class="mb-3">
                    <label class="form-label" for="username">Tên tài khoản</label>
                    <input class="form-control" id="username" name="username" type="text" value="{{ $user->name }}" />
                    <span class="text-danger" id="usernameError"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-control" id="email" name="email" type="email" value="{{ $user->email }}"/>
                    <span class="text-danger" id="emailError"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Số điện thoại</label>
                    <input class="form-control" id="phone" name="phone" type="tel" value="{{ $user->phone }}" />
                    <span class="text-danger" id="phoneError"></span>
                </div>
                <div class="mb-3">
                    <label class="form-label">Giới tính</label>
                    <div>
                        <input id="male" name="gender" type="radio" value="male" {{ $user->gender == 'male' ? 'checked' : '' }} />
                        <label for="male">Nam</label>
                        <input id="female" name="gender" type="radio" value="female" {{ $user->gender == 'female' ? 'checked' : '' }} />
                        <label for="female">Nữ</label>
                        <input id="other" name="gender" type="radio" value="other" {{ $user->gender == 'other' ? 'checked' : '' }} />
                        <label for="other">Khác</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="birthdate">Ngày sinh</label>
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-select" id="day" name="day">
                                <option selected disabled>Ngày</option>
                                @for ($d = 1; $d <= 31; $d++)
                                    <option value="{{ $d }}" {{ isset($day) && $day == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="month" name="month">
                                <option selected disabled>Tháng</option>
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ isset($month) && $month == $m ? 'selected' : '' }}>Tháng {{ $m }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" id="year" name="year">
                                <option selected disabled>Năm</option>
                                @for ($y = 1950; $y <= 2024; $y++)
                                    <option value="{{ $y }}" {{ isset($year) && $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn btn-save" id="saveButton" type="submit">Lưu</button>
            </div>
            <div class="col-md-4 profile-image">
                <div class="short-border-left"></div> <!-- Đường viền bên trái ngắn -->
                <img alt="Profile image" height="100" src="{{ $user->profile_image ? asset($user->profile_image) : 'https://storage.googleapis.com/a1aa/image/JvrL8IccnN7JEFHYrd8lG4Pkxxr1MJyu5roHmDKfPBx2sy1JA.jpg' }}" width="100" id="profileImage" />





                <!-- Thêm thẻ input để chọn ảnh -->
                <input type="file" id="imageUpload" name="profile_image" accept=".jpg, .jpeg, .png" style="display: none;" />
                <button class="btn btn-outline-secondary mt-2" type="button" id="chooseImageButton">Chọn Ảnh</button>
                <p class="form-text text-center mt-2">Dung lượng file tối đa 1 MB<br />Định dạng: .JPEG, .PNG</p>
            </div>
        </div>
    </form>
</div>

@endsection
