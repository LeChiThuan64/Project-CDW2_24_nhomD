<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('viewUser.login'); // replace with your login view name
    }

    public function login(Request $request)
    {
        // Kiểm tra xem email và mật khẩu có được cung cấp hay không
        if (!$request->filled('email') || !$request->filled('password')) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng nhập đầy đủ thông tin đăng nhập.'], 422);
        }

        // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu hay không
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Email không tồn tại.'], 401);
        }
        // Kiểm tra nếu tài khoản đã bị khóa
        if ($user->is_active == 0) {
            return response()->json(['status' => 'error', 'message' => 'Tài khoản của bạn đã bị khóa.'], 403);
        }
        // Kiểm tra thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Lấy thông tin người dùng đã xác thực
            $user = Auth::user();

            // Kiểm tra cột 'role' và chuyển hướng theo giá trị của nó
            if ($user->role == 1) {
                return response()->json(['status' => 'success', 'redirect' => route('wishlist.index')]);
            } elseif ($user->role == 0) {
                return response()->json(['status' => 'success', 'redirect' => route('dashboard')]);
            }
        }

        // Nếu không thành công, trả về lỗi
        return response()->json(['status' => 'error', 'message' => 'Mật khẩu không chính xác.'], 401);
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/auth'); // replace with your desired logout redirect
    }
}
