<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('vieuwUser.login'); // replace with your login view name
    }

    public function login(Request $request)
    {
        // Thông báo lỗi
        $errors = [];
    
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
        }
    
        // Kiểm tra mật khẩu
        if (empty($request->password)) {
            $errors['password'] = ['Vui lòng nhập mật khẩu.'];
        } elseif (strlen($request->password) < 5 || strlen($request->password) > 25) {
            $errors['password'] = ['Mật khẩu không hợp lệ, vui lòng nhập từ 5-25 ký tự.'];
        } elseif (!preg_match('/[a-z]/', $request->password) || 
                  !preg_match('/[A-Z]/', $request->password) || 
                  !preg_match('/[0-9]/', $request->password) || 
                  !preg_match('/[\W_]/', $request->password)) {
            $errors['password'] = ['Mật khẩu không đủ mạnh, vui lòng đảm bảo có chữ thường, chữ HOA, số và ký tự đặc biệt.'];
        }
    
        // Nếu có lỗi, trả về JSON với các lỗi
        if (!empty($errors)) {
            return response()->json(['status' => 'error', 'errors' => $errors], 422);
        }
    
        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return response()->json(['status' => 'success', 'redirect' => route('home')]);
        }
    
        // Nếu không thành công, trả về lỗi
        return response()->json(['status' => 'error', 'message' => 'Tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại.'], 401);
    }
    


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/'); // replace with your desired logout redirect
    }
}
