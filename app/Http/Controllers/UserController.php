<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ người dùng
        $search = $request->input('search');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($search) {
            // Tìm kiếm theo ID hoặc tên người dùng
            $users = User::where('user_id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->paginate(10);
        } else {
            // Nếu không có tìm kiếm, hiển thị danh sách user mặc định
            $users = User::paginate(10);
        }

        // Kiểm tra nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return view('vieuwAdmin.tables', compact('users'))->render();
        }

        // Trả về view chính khi không phải AJAX
        return view('vieuwAdmin.tables', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'Xóa được rồi!');
        }

        return redirect()->back()->with('error', 'Thua Ban oi!');
    }

    public function create()
    {
        // Trả về view addUser.blade.php
        return view('vieuwAdmin.addUser'); // Điều chỉnh đường dẫn nếu cần
    }

     // Lưu người dùng mới
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
    
        // Tạo người dùng mới với role mặc định là 1
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 1, // Role mặc định
        ]);
    
        // Chuyển hướng về trang /tables sau khi thêm người dùng thành công
        return redirect()->route('tables')->with('success', 'Người dùng đã được thêm thành công!');
    }
    
}
