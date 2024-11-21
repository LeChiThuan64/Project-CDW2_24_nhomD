<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AccessControlMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy thông tin vai trò người dùng
        $role = Auth::check() ? Auth::user()->role : null;

        // Lấy tên route hiện tại
        $currentRoute = $request->route()->getName();

        // Định nghĩa danh sách các route bị chặn cho user
        $restrictedRoutesForUser = ['dashboard'];

        // Nếu user đã đăng nhập nhưng bị chặn
        if ($role === "1" && in_array($currentRoute, $restrictedRoutesForUser)) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Nếu admin, hoặc user không bị chặn, hoặc khách đều được truy cập
        return $next($request);
    }
}
