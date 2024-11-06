<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Đảm bảo import Log ở đầu file


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
    
        // Kiểm tra nếu ngày sinh có giá trị, sau đó tách thành ngày, tháng, năm
        if ($user->dob) {
            $day = $user->dob->day;
            $month = $user->dob->month;
            $year = $user->dob->year;
        } else {
            $day = $month = $year = null; // Trường hợp ngày sinh rỗng
        }
    
        return view('viewUser.profile', compact('user', 'day', 'month', 'year'));
    }


    
    
    public function update(Request $request, $id)
    {
        Log::info('Update function called');
    
        // Xác thực dữ liệu
        $request->validate([
            'username' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|string|max:10',
            'day' => 'nullable|integer',
            'month' => 'nullable|integer',
            'year' => 'nullable|integer',
            'profile_image' => 'nullable|image|mimes:jpeg,png|max:1024',
        ]);
    
        // Tìm người dùng
        $user = User::findOrFail($id);
    
        // Cập nhật thông tin người dùng
        $user->name = $request->username;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
    
        // Cập nhật ngày sinh
        if ($request->day && $request->month && $request->year) {
            $user->dob = "{$request->year}-{$request->month}-{$request->day}";
        }
    
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
            $user->profile_image = $profileImagePath;
        }
        
        // Lưu thay đổi
        $user->save();
    
        // Chuyển hướng lại với thông báo thành công
        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công!');
    }
    
    
    
    
}
