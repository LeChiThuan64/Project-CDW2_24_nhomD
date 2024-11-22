<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Kiểm tra xem người dùng có yêu cầu dữ liệu dạng JSON không, nếu có thì không chuyển hướng
        if ($request->expectsJson()) {
            return null;
        }

        // Nếu không, kiểm tra cookie remember_token và tự động đăng nhập nếu có
        if ($request->hasCookie('remember_token')) {
            $rememberToken = $request->cookie('remember_token');
            
            // Tìm người dùng dựa trên remember_token
            $user = User::where('remember_token', $rememberToken)->first();
            
            if ($user) {
                // Đăng nhập người dùng nếu tìm thấy remember_token hợp lệ
                Auth::login($user, true);  // Tham số true sẽ ghi nhớ người dùng
            }
        }

        // Chuyển hướng đến trang login nếu người dùng chưa đăng nhập
        return route('login');
    }
    
}
