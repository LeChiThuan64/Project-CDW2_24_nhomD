<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use App\Models\ContactMessage; // Nếu bạn tạo model cho contact_messages

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        $request->validate([
            'message' => 'required|string',
        ]);

        // Nếu người dùng đã đăng nhập, lấy name và email từ auth, ngược lại lấy từ request
        $name = auth()->check() ? auth()->user()->name : $request->input('name');
        $email = auth()->check() ? auth()->user()->email : $request->input('email');

        DB::table('contact_messages')->insert([
            'name' => $name,
            'email' => $email,
            'message' => $request->input('message'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'gửi thành công!');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
