@extends('viewUser.navigation')
@section('title', 'Reset Password')
@section('content')





<main>
    <section class="container">
        <h2 class="section-title text-center">Reset Your Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $email ?? old('email') }}" required readonly>
                <label>Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" placeholder="New Password" required>
                <label>New Password</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                <label>Confirm Password</label>
            </div>
            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
        </form>
    </section>
</main>

@endsection
