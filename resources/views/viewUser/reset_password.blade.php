@extends('viewUser.navigation')
@section('title', 'Reset Password')
@section('content')

@if (session('status'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let statusMessage = "Chúng tôi đã gửi cho bạn liên kết đặt lại mật khẩu qua email.";
        let type = 'info'; // Bạn có thể thay đổi type nếu cần (error, warning, info)
        createToast(type, 'fa-solid fa-circle-check', 'Success', statusMessage);
    });
</script>
@endif

<main>
    <div class="mb-4 pb-4"></div>
    <section class="login-register container">
        <h2 class="section-title text-center fs-3 mb-xl-5">Reset Your Password</h2>
        <p>We will send you an email to reset your password</p>
        <div class="reset-form">
            <form name="reset-form" class="needs-validation" method="POST" action="{{ route('password.email') }}" novalidate>
                @csrf
                <div class="form-floating mb-3">
                    <input
                        name="email"
                        type="email"
                        class="form-control form-control_gray @error('email') is-invalid @enderror"
                        id="customerNameEmailInput"
                        placeholder="Email address *"
                        value="{{ old('email') }}"
                        required>
                    <label for="customerNameEmailInput">Email address *</label>

                    <!-- Hiển thị tất cả lỗi -->
                    @if ($errors->has('email'))
                    <div id="email-error" class="text-danger">
                        @foreach ($errors->get('email') as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    @endif
                </div>


                <button class="btn btn-primary w-100 text-uppercase" type="submit">Submit</button>



                <div class="customer-option mt-4 text-center">
                    <span class="text-secondary">Back to</span>
                    <a href="{{ route('auth') }}" class="btn-text js-show-register">Login</a>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    document.querySelector('form[name="reset-form"]').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn form gửi dữ liệu đồng bộ

        let form = event.target;
        let formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                // Xóa các lỗi cũ
                document.querySelectorAll('.text-danger').forEach(el => el.remove());

                if (data.status === 'error') {
                    // Hiển thị lỗi
                    for (const [field, messages] of Object.entries(data.errors)) {
                        let input = document.querySelector(`[name="${field}"]`);
                        if (input) {
                            let errorDiv = document.createElement('div');
                            errorDiv.classList.add('text-danger', 'mt-1');
                            errorDiv.innerHTML = messages.join('<br>');
                            input.closest('.form-floating').appendChild(errorDiv);
                        }
                    }
                } else if (data.status === 'success') {
                    // Hiển thị thông báo thành công

                    let statusMessage = data.message;
                    let type = 'info'; // Bạn có thể thay đổi type nếu cần (error, warning, info)
                    createToast(type, 'fa-solid fa-circle-check', 'Success', statusMessage);
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
@endsection