<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{

    public function showResetForm(Request $request, $token = null)
    {
        return view('viewUser.reset_form', ['token' => $token, 'email' => $request->email]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
            ]
        );
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'errors' => ['email' => ['Tài khoản không tồn tại, vui lòng nhập lại.']],
            ], 404);
        }
    
        $response = Password::broker()->sendResetLink($request->only('email'));
    
        return $response == Password::RESET_LINK_SENT
            ? response()->json(['status' => 'success', 'message' => __('Đã gửi email đặt lại mật khẩu. Vui lòng kiểm tra hộp thư!')])
            : response()->json(['status' => 'error', 'errors' => ['email' => [__('Không thể gửi email đặt lại mật khẩu. Vui lòng chờ và thử lại.')]]], 500);
    }
    
    

    

    

    public function showLinkRequestForm()
    {
        return view('viewUser.reset_password');
    }


    public function reset(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Ghi log để kiểm tra dữ liệu nhận được từ form
        Log::info('Received reset request', [
            'email' => $request->email,
            'token' => $request->token,
            'password' => $request->password
        ]);

        // Kiểm tra token reset
        $resetToken = DB::table('password_reset_tokens')->where('email', '=', $request->email)->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            // Nếu token không hợp lệ hoặc không khớp, ghi log lỗi và trả về thông báo
            Log::error('Invalid or expired token for email: ' . $request->email);
            return back()->withErrors(['token' => 'Mã thông báo không hợp lệ hoặc đã hết hạn.']);
        } else {
            // Nếu token hợp lệ, ghi log để kiểm tra
            Log::info('Token valid for email: ' . $request->email);
        }

        // Kiểm tra sự tồn tại của người dùng
        $user = User::where('email', $request->email)->first();

        // Nếu người dùng không tồn tại, ghi log lỗi và trả về thông báo
        if (!$user) {
            Log::error('User not found for email: ' . $request->email);
            return back()->withErrors(['email' => 'Người dùng không tồn tại.']);
        } else {
            // Nếu người dùng tồn tại, ghi log để kiểm tra
            Log::info('User found for email: ' . $request->email);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->password);
        $user->save();

        // Ghi log khi mật khẩu đã được cập nhật
        Log::info('Password updated for email: ' . $request->email);

        // Xóa token reset sau khi sử dụng
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Chuyển hướng về trang đăng nhập với thông báo thành công
        return redirect()->route('auth')->with('status', 'Đặt lại mật khẩu thành công!');
    }
}
