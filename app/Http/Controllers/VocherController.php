<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class VocherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::all(); // Sửa 'Vocher::all()' thành 'Voucher::all()'
        return view('viewAdmin.vocher', compact('vouchers'));
    }
    public function create()
    {
        // Lấy danh sách người dùng để hiển thị trong form, nếu cần thiết
        $users = User::all();
        return view('viewAdmin.create_vocher', compact('users'));
    }

    public function store(Request $request)
    {
        $vocher = new Voucher();
        $vocher->name = $request->name;
        $vocher->description = $request->description;
        $vocher->discount = $request->discount;
        $vocher->start_date = $request->start_date;
        $vocher->end_date = $request->end_date;

        if ($request->apply_to == 'all') {
            $vocher->is_global = true;
        } else {
            $vocher->is_global = false;
            $vocher->user_id = $request->user_id; // Lưu ID người dùng cụ thể
        }

        $vocher->save();

        return redirect()->route('vocher.index')->with('success', 'Voucher đã được tạo thành công!');
    }

    public function destroy($id)
    {
        $vocher = Voucher::findOrFail($id);
        $vocher->delete();

        return redirect()->route('vocher.index')->with('success', 'Voucher đã được xóa thành công!');
    }


    // public function edit($id)
    // {
    //     // Lấy voucher theo ID
    //     $vocher = Voucher::findOrFail($id);
    //     $users = User::all(); // Lấy danh sách người dùng để chọn trong trường "áp dụng cho"
    //     return view('viewAdmin.edit_vocher', compact('vocher', 'users'));
    // }
    public function edit($encryptedId)
    {
        try {
            // Giải mã `id`
            $id = Crypt::decrypt($encryptedId);
    
            // Lấy dữ liệu voucher dựa vào `id` đã giải mã
            $vocher = Voucher::findOrFail($id);
            $users = User::all(); // Lấy danh sách người dùng để chọn trong trường "áp dụng cho"
            
            return view('viewAdmin.edit_vocher', compact('vocher', 'users'));
        } catch (\Exception $e) {
            // Xử lý lỗi khi giải mã thất bại
            return redirect()->route('vocher.index')->with('error', 'Không thể truy cập voucher này.');
        }
    }

    public function update(Request $request, $id)
    {
        $vocher = Voucher::findOrFail($id);

        $vocher->name = $request->name;
        $vocher->description = $request->description;
        $vocher->discount = $request->discount;
        $vocher->start_date = $request->start_date;
        $vocher->end_date = $request->end_date;

        if ($request->apply_to == 'all') {
            $vocher->is_global = true;
            $vocher->user_id = null;
        } else {
            $vocher->is_global = false;
            $vocher->user_id = $request->user_id;
        }

        $vocher->save();

        return redirect()->route('vocher.index')->with('success', 'Voucher đã được cập nhật thành công!');
    }
}
