@extends('viewUser.navigation')
@section('title', 'Register')
@section('content')

<!-- Register Form -->


<div class="container layout">
    <div class="tabs">
        <div id="login-tab" class="{{ Request::is('login') ? 'active' : '' }}">LOGIN</div>
        <div id="register-tab" class="{{ Request::is('register') ? 'active' : '' }}">REGISTER</div>
    </div>
    <div id="register-container" class="form-container active">
        <form id="register-form" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Username" required>
                <span class="text-danger" id="name-error"></span> <!-- Vị trí hiển thị lỗi -->
            </div>

            <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email address *" required>
                <span class="text-danger" id="email-error"></span> <!-- Vị trí hiển thị lỗi -->
            </div>

            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password *" required>
                <span class="text-danger" id="password-error"></span> <!-- Vị trí hiển thị lỗi -->
            </div>

            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password *" required>
                <span class="text-danger" id="password-confirmation-error"></span> <!-- Vị trí hiển thị lỗi -->
            </div>

            <button type="submit" class="btn">REGISTER</button>
            <span class="text-danger" id="register-error"></span> <!-- Vị trí hiển thị lỗi tổng quát -->
        </form>
    </div>
</div>

@endsection