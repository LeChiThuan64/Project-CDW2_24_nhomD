<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   
    public function login(Request $request)
    {
        // Kiểm tra thông tin đầu vào chỉ cần trường trống
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        // Kiểm tra xem email có tồn tại không
        $user = \App\Models\User::where('email', $request->email)->first();
    
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'errors' => ['email' => ['Email không tồn tại.']],
            ], 401);
        }
    
        // Kiểm tra tài khoản có bị khóa không
        if ($user->is_active == 0) {
            return response()->json([
                'status' => 'error',
                'errors' => ['email' => ['Tài khoản của bạn đã bị khóa.']],
            ], 403);
        }
    
        // Xác thực thông tin đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            $user = Auth::user();
    
            // Chuyển hướng theo vai trò
            if ($user->role == 1) {
                return response()->json([
                    'status' => 'success',
                    'redirect' => route('home.show'),
                ]);
            } elseif ($user->role == 0) {
                return response()->json([
                    'status' => 'success',
                    'redirect' => route('dashboard'),
                ]);
            }
        }
    
        // Nếu mật khẩu không đúng
        return response()->json([
            'status' => 'error',
            'errors' => ['password' => ['Mật khẩu không chính xác.']],
        ], 401);
    }
    
    
    



    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/auth'); // replace with your desired logout redirect
    }
}
