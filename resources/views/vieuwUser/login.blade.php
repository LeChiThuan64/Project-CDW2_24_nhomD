@extends('vieuwUser.navLogin_Register')
@section('title', 'Login')
@section('content')

<!-- Login Form -->
<div id="login-container" class="form-container active">
    <form id="login-form" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="Email address *" required>
            <span class="text-danger" id="email-error"></span> <!-- Vị trí hiển thị lỗi -->
        </div>
        <div class="form-group">
            <input type="password" name="password" id="password" placeholder="Password *" required>
            <span class="text-danger" id="password-error"></span> <!-- Vị trí hiển thị lỗi -->
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <label><input type="checkbox" name="remember" id="remember"> Remember me</label>
            <a href="#">Lost password?</a>
        </div>
        <span class="text-danger" id="login-error"></span> <!-- Vị trí hiển thị lỗi tổng quát -->
        <button type="submit" class="btn" id="login-btn">LOG IN</button>
    </form>
</div>


@endsection
