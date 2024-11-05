@extends('viewUser.navigation')
@section('title', 'Authentication')
@section('content')

<div class="container layout">
    <div class="tabs">
        <div id="login-tab" class="{{ request('showRegister') ? '' : 'active' }}">LOGIN</div>
        <div id="register-tab" class="{{ request('showRegister') ? 'active' : '' }}">REGISTER</div>
    </div>

    <div id="login-container" class="form-container {{ request('showRegister') ? '' : 'active' }}">
    <form id="login-form" method="POST" action="{{ route('login.signin') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="login-name" placeholder="name  *" required>
                <span class="text-danger" id="login-name-error"></span> <!-- Thông báo lỗi cho email -->
            </div>
            <div class="form-group">
                <input type="password" name="password" id="login-password" placeholder="Password *" required>
                <span class="text-danger" id="login-password-error"></span> <!-- Thông báo lỗi cho mật khẩu -->
            </div>
            <button type="submit" class="btn">LOG IN</button>
            <span class="text-danger" id="login-error"></span> <!-- Thông báo lỗi chung (nếu có) -->
        </form>
    </div>

    <div id="register-container" class="form-container {{ request('showRegister') ? 'active' : '' }}">
        <form id="register-form" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Username" required>
                <span class="text-danger" id="name-error"></span>
            </div>
            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email address *" required>
                <span class="text-danger" id="email-error"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password *" required>
                <span class="text-danger" id="password-error"></span>
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password *" required>
                <span class="text-danger" id="password_confirmation-error"></span>
            </div>
            <button type="submit" class="btn">REGISTER</button>
            <span class="text-danger" id="register-error"></span>
        </form>
    </div>
</div>

@endsection