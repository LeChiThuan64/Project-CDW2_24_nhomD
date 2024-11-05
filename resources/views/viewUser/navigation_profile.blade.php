@extends('viewUser.navigation')
@section('title', 'Nav tools')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" type="text/css">
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

<!-- $user = Auth::user(); -->


<div class="container-fluid container-profile">
    <div class="row">
        <div class="col-md-3 sidebar">
            <div class="text-center">
            <img alt="User profile picture" class="rounded-circle" height="100"
     src="{{ Auth::check() ? asset(Auth::user()->profile_image) : asset('uploads/user.png') }}"
     width="100" />

                <p>jzpu2v0e9k</p>
                <a href="#">Sửa Hồ Sơ</a>
            </div>
            <a href="#accountCollapse" role="button">
                <i class="fas fa-user"></i>
                Tài Khoản Của Tôi
            </a>
            <div class="collapse" id="accountCollapse">
                <a class="active" href="#">
                    <i class="fas fa-id-card"></i>
                    Hồ Sơ
                </a>
                <a href="#">
                    <i class="fas fa-lock"></i>
                    Đổi Mật Khẩu
                </a>
                <a href="#">
                    <i class="fas fa-bell"></i>
                    Cài Đặt Thông Báo
                </a>
            </div>
            <a href="#"><i class="fas fa-box"></i> Đơn Mua</a>
            <a href="#"><i class="fas fa-bell"></i> Phiếu Giảm Giá </a>
        </div>
        <div class="col-md-9">
            @yield('contentProfile')
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyDkIu0+UGx0vRrltyqO0xN/5TqBk9iA3dO6M"
    crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/profile.js') }}" defer="defer"></script>
@endsection