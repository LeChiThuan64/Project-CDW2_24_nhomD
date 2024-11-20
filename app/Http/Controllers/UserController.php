<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Encryption\DecryptException;

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
            $user->profile_image = $user->profile_image ? asset(ltrim($user->profile_image, '/')) : asset('path/to/default-image.jpg');
            return response()->json($user);
        }
        return response()->json(['error' => 'User not found'], 404);
    }

    //khóa user
    public function toggleStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->is_active = $request->input('is_active');
        $user->save();

        return response()->json([
            'message' => $user->is_active == 1 ? 'Tài khoản đã được mở khóa!' : 'Tài khoản đã bị khóa!',
        ]);
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






    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('viewAdmin.edit_user', compact('user'));
    // }


    // public function edit($encryptedId)
    // {
    //     $id = Crypt::decryptString($encryptedId);
    //     $user = User::findOrFail($id);
    //     return view('viewAdmin.edit_user', compact('user'));
    // }
    public function edit($encryptedId)
    {
        try {
            // Giải mã ID
            $id = Crypt::decryptString($encryptedId);
            $user = User::findOrFail($id);
            return view('viewAdmin.edit_user', compact('user'));
        } catch (DecryptException $e) {
            // Thông báo lỗi nếu ID không hợp lệ
            return redirect()->route('tables')->with('error', 'ID người dùng không hợp lệ.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|regex:/@gmail\.com$/|unique:users,email,' . $id,
            'phone' => 'nullable|numeric|digits:10', // Cho phép phone là null
            'gender' => 'required|in:male,female,other',
            'dob' => 'nullable|date', // Cho phép dob là null
            'profile_image' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);

        $user = User::findOrFail($id);

        // Cập nhật thông tin người dùng bao gồm cả các trường trống trước đó
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone') ?: $user->phone, // Giữ giá trị cũ nếu không có input
            'gender' => $request->input('gender'),
            'dob' => $request->input('dob') ?: $user->dob, // Giữ giá trị cũ nếu không có input
        ]);

        // Kiểm tra và lưu ảnh nếu có file ảnh tải lên
        if ($request->hasFile('profile_image')) {
            // Nếu người dùng đã có ảnh trước đó, xóa ảnh cũ
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }

            // Đường dẫn thư mục lưu ảnh
            $directoryPath = public_path('uploads');

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            // Lưu ảnh mới
            $profileImageName = $request->file('profile_image')->getClientOriginalName();
            $request->file('profile_image')->move($directoryPath, $profileImageName);

            // Cập nhật đường dẫn ảnh vào cơ sở dữ liệu
            $profileImagePath = 'uploads/' . $profileImageName;
            $user->update(['profile_image' => $profileImagePath]);
        }

        return redirect()->route('tables')->with('success', 'Cập nhật thành công!');
    }
}
