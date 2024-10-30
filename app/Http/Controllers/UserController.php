<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ người dùng
        $search = $request->input('search');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($search) {
            // Tìm kiếm theo ID hoặc tên người dùng
            $users = User::where('id', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->paginate(10);
        } else {
            // Nếu không có tìm kiếm, hiển thị danh sách user mặc định
            $users = User::paginate(10);
        }

        // Kiểm tra nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return view('viewAdmin.tables', compact('users'))->render();
        }

        // Trả về view chính khi không phải AJAX
        return view('viewAdmin.tables', compact('users'));
    }

    // Hiển thị model
    public function show($id)
{
    $user = User::find($id);
    if ($user) {
        // Đảm bảo chỉ thêm 'uploads/' một lần
        $user->profile_image = $user->profile_image ? asset(  ltrim($user->profile_image, '/')) : asset('path/to/default-image.jpg');
        return response()->json($user);
    }
    return response()->json(['error' => 'User not found'], 404);
}

    
    




    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            if ($user->profile_image) {
                Storage::delete($user->profile_image); // Xóa ảnh cũ
            }
            $user->delete();
            return redirect()->back()->with('success', 'Xóa thành công!');
        }
        return redirect()->back()->with('error', 'Không tìm thấy người dùng!');
    }

    public function create()
    {
        return view('viewAdmin.addUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'nullable|numeric|digits:10',
            'gender' => 'required|in:male,female,other',
            'dob' => 'nullable|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        try {
            $profileImagePath = null;

            // Đường dẫn thư mục lưu ảnh
            $directoryPath = public_path('uploads');

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            if ($request->hasFile('profile_image')) {
                $profileImageName = $request->file('profile_image')->getClientOriginalName();
                $request->file('profile_image')->move($directoryPath, $profileImageName);

                // Lưu đường dẫn ảnh để lưu vào cơ sở dữ liệu
                $profileImagePath = 'uploads/' . $profileImageName;
            }

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'phone' => $request->input('phone'),
                'gender' => $request->input('gender'),
                'dob' => $request->input('dob'),
                'role' => 1,
                'profile_image' => $profileImagePath,
            ]);

            return redirect()->route('tables')->with('success', 'Người dùng đã được thêm thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Không thể thêm user, vui lòng thử lại.');
        }
    }






    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('viewAdmin.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|regex:/@gmail\.com$/|unique:users,email,' . $id,
            'phone' => 'required|numeric|digits:10',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'profile_image' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'email', 'phone', 'gender', 'dob']));

        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::delete($user->profile_image); // Xóa ảnh cũ trước khi cập nhật
            }
            $path = $request->file('profile_image')->store('uploads');
            $user->update(['profile_image' => $path]);
        }

        return redirect()->route('tables')->with('success', 'Cập nhật thành công!');
    }
}
