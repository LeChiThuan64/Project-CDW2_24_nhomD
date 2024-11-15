@extends('viewUser.navigation')
@section('title', 'Authentication')
@section('content')
@if (session('no-login-wishlist'))
<script>
    alert("{{ session('no-login-wishlist') }}");
</script>
@endif
<main>
    <div class="mb-4 pb-4"></div>
    <section class="login-register container">
        <h2 class="d-none">Login & Register</h2>
        <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore active" id="login-tab" data-bs-toggle="tab" href="#tab-item-login" role="tab" aria-controls="tab-item-login" aria-selected="true">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link nav-link_underscore" id="register-tab" data-bs-toggle="tab" href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="false">Register</a>
            </li>
        </ul>
        <div class="tab-content pt-2" id="login_register_tab_content">
            <!-- Login Form -->
            <div class="tab-pane fade show active" id="tab-item-login" role="tabpanel" aria-labelledby="login-tab">
                <div class="login-form">
                    <form id="login-form" name="login-form" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control form-control_gray" id="emailInput" placeholder="Email address *" required>
                            <label for="emailInput">Email address *</label>
                            <div id="login-email-error" class="text-danger"></div> <!-- Hiển thị lỗi email -->
                        </div>

                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control form-control_gray" id="passwordInput" placeholder="Password *" required>
                            <label for="passwordInput">Password *</label>
                            <div id="login-password-error" class="text-danger"></div> <!-- Hiển thị lỗi password -->
                        </div>

                        <div id="login-error" class="text-danger mb-3"></div> <!-- Hiển thị lỗi tổng quát -->

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Log In</button>
                    </form>



                </div>
            </div>

            <!-- Register Form -->
            <div class="tab-pane fade" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
                <div class="register-form">
                    <form name="register-form" id="register-form" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input name="name" type="text" class="form-control form-control_gray" id="customerNameRegisterInput" placeholder="Username" required>
                            <label for="customerNameRegisterInput">Username</label>
                            <span id="name-error" class="text-danger"></span>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="email" type="email" class="form-control form-control_gray" id="customerEmailRegisterInput" placeholder="Email address *" required>
                            <label for="customerEmailRegisterInput">Email address *</label>
                            <span id="email-error" class="text-danger"></span>
                        </div>

                        <div class="pb-3"></div>

                        <div class="form-floating mb-3">
                            <input name="password" type="password" class="form-control form-control_gray" id="customerPasswodRegisterInput" placeholder="Password *" required>
                            <label for="customerPasswodRegisterInput">Password *</label>
                            <span id="password-error" class="text-danger"></span>
                        </div>

                        <div class="form-floating mb-3">
                            <input name="password_confirmation" type="password" class="form-control form-control_gray" id="customerConfirmPasswodRegisterInput" placeholder="Confirm Password *" required>
                            <label for="customerConfirmPasswodRegisterInput">Confirm Password *</label>
                            <span id="password_confirmation-error" class="text-danger"></span>
                        </div>

                        <div class="d-flex align-items-center mb-3 pb-2">
                            <p class="m-0">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                        </div>

                        <button class="btn btn-primary w-100 text-uppercase" type="submit">Register</button>
                        <span id="register-error" class="text-danger"></span>
                    </form>

                </div>
            </div>
        </div>
    </section>
</main>


<script>
        const loginUrl = "{{ route('login') }}";
        const registerUrl = "{{ route('register') }}";
        const authUrl = "{{ route('auth') }}";
    </script>

@endsection