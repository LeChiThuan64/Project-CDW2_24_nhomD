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
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);
        
    
        // Tìm người dùng
        $user = User::findOrFail($id);
        
    
        // Cập nhật thông tin
        $user->name = $request->username;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
    
        // Cập nhật ngày sinh
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;
        if ($day && $month && $year) {
            $user->dob = "$year-$month-$day"; // Định dạng: YYYY-MM-DD
        }
    
        // Cập nhật hình ảnh
        if ($request->hasFile('profile_image')) {
            // Xóa hình ảnh cũ nếu có
            if ($user->profile_image) {
                Storage::delete($user->profile_image);
            }
            // Lưu hình ảnh mới
            $path = $request->file('profile_image')->store('profile_images');
            $user->profile_image = $path;
        }
    
        // Lưu thay đổi
        $user->save();
    
        // Chuyển hướng hoặc trả về thông báo thành công
        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công!');
    }
    
    
    
}
