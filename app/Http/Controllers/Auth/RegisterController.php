<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{

    // Xử lý yêu cầu đăng ký người dùng mới
    public function register(Request $request)
    {
        // Thực hiện xác thực dữ liệu đầu vào với thông báo tiếng Việt
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:100',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    'unique:users,email',
                    'regex:/^[a-zA-Z0-9@._-]+$/'
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'max:25',
                    'confirmed', // Đảm bảo mật khẩu và xác nhận mật khẩu khớp
                    'regex:/[a-z]/',           // Phải có ít nhất một chữ cái thường
                    'regex:/[A-Z]/',           // Phải có ít nhất một chữ cái HOA
                    'regex:/[0-9]/',           // Phải có ít nhất một chữ số
                    'regex:/[\W_]/'            // Phải có ít nhất một ký tự đặc biệt
                ],
            ], [
                'name.required' => 'Vui lòng nhập tên người dùng.',
                'name.string' => 'Tên người dùng phải là một chuỗi ký tự.',
                'name.max' => 'Tên người dùng không được vượt quá 100 ký tự.',

                'email.required' => 'Vui lòng nhập địa chỉ email.',
                'email.email' => 'Địa chỉ email không hợp lệ.',
                'email.max' => 'Địa chỉ email không được vượt quá 255 ký tự.',
                'email.unique' => 'Địa chỉ email này đã được đăng ký.',
                'email.regex' => 'Địa chỉ email chỉ được chứa các ký tự chữ cái, số và dấu chấm, gạch ngang, gạch dưới.',

                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.max' => 'Mật khẩu không được vượt quá 25 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
                'password.regex' => 'Mật khẩu phải có ít nhất một chữ cái thường, một chữ cái hoa, một chữ số và một ký tự đặc biệt.',

                'password_confirmation.confirmed' => 'Mật khẩu xác nhận không khớp.',
            ]);
        } catch (ValidationException $e) {
            // Nếu có lỗi xác thực, trả về JSON với chi tiết lỗi và mã trạng thái 422
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        }

        // Tạo người dùng mới nếu không có lỗi
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Trả về phản hồi JSON thành công
        return response()->json([
            'status' => 'success',
            'message' => 'Đăng ký thành công. Bạn có thể đăng nhập ngay bây giờ.'
        ]);
    }
}
