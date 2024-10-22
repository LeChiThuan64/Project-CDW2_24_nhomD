<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('viewUser.register'); // Điều hướng tới view đăng ký
    }

    // Xử lý yêu cầu đăng ký người dùng mới
    public function register(Request $request)
    {
        // Thông báo lỗi
        $errors = [];
    
        // Kiểm tra tên người dùng
        if (empty($request->name)) {
            $errors['name'] = ['Vui lòng nhập tên người dùng.'];
        } elseif (strlen($request->name) > 100) {
            $errors['name'] = ['Tên người dùng không được dài quá 100 ký tự.'];
        }

        // Kiểm tra email
        if (empty($request->email)) {
            $errors['email'] = ['Vui lòng nhập địa chỉ email.'];
        } elseif (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = ['Địa chỉ email không hợp lệ, vui lòng nhập lại.'];
        } elseif (preg_match('/[^a-zA-Z0-9@._-]/', $request->email)) {
            $errors['email'] = ['Email chứa ký tự không hợp lệ.'];
        } elseif (substr_count($request->email, '@') != 1 || 
                  strpos($request->email, '@') == 0 || 
                  strrpos($request->email, '.') < strpos($request->email, '@')) {
            $errors['email'] = ['Vui lòng nhập địa chỉ email có ký tự trước và sau dấu @.'];
        } elseif (preg_match('/\s/', $request->email)) {
            $errors['email'] = ['Email chứa khoảng trắng hoặc ký tự không được phép.'];
        } elseif (User::where('email', $request->email)->exists()) {
            $errors['email'] = ['Email này đã được sử dụng.'];
        }

        // Kiểm tra mật khẩu
        if (empty($request->password)) {
            $errors['password'] = ['Vui lòng nhập mật khẩu.'];
        } elseif (strlen($request->password) < 8 || strlen($request->password) > 25) {
            $errors['password'] = ['Mật khẩu không hợp lệ, vui lòng nhập từ 8-25 ký tự.'];
        } elseif (!preg_match('/[a-z]/', $request->password) || 
                  !preg_match('/[A-Z]/', $request->password) || 
                  !preg_match('/[0-9]/', $request->password) || 
                  !preg_match('/[\W_]/', $request->password)) {
            $errors['password'] = ['Mật khẩu không đủ mạnh, vui lòng đảm bảo có chữ thường, chữ HOA, số và ký tự đặc biệt.'];
        }

        // Kiểm tra xác nhận mật khẩu
        if (empty($request->password_confirmation)) {
            $errors['password_confirmation'] = ['Vui lòng nhập lại mật khẩu để xác nhận.'];
        } elseif ($request->password !== $request->password_confirmation) {
            $errors['password_confirmation'] = ['Mật khẩu xác nhận không khớp.'];
        }

        // Nếu có lỗi, trả về JSON với các lỗi
        if (!empty($errors)) {
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        }

        // Tạo người dùng mới nếu không có lỗi
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Nếu đăng ký thành công, trả về thành công
        return response()->json(['status' => 'success', 'message' => 'Đăng ký thành công. Bạn có thể đăng nhập ngay bây giờ.']);
    }
}
