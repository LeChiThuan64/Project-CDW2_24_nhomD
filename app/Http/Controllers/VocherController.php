<?php

namespace App\Http\Controllers;

use App\Models\Vocher;
use App\Models\User;
use Illuminate\Http\Request;

class VocherController extends Controller
{
    public function index()
    {
        // Lấy danh sách tất cả các voucher
        $vochers = Vocher::all();
        return view('viewAdmin.vocher', compact('vochers'));
    }
    public function create()
    {
        // Lấy danh sách người dùng để hiển thị trong form, nếu cần thiết
        $users = User::all();
        return view('viewAdmin.create_vocher', compact('users'));
    }

    public function store(Request $request)
    {
        $vocher = new Vocher();
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
        $vocher = Vocher::findOrFail($id);
        $vocher->delete();

        return redirect()->route('vocher.index')->with('success', 'Voucher đã được xóa thành công!');
    }


    public function edit($id)
    {
        // Lấy voucher theo ID
        $vocher = Vocher::findOrFail($id);
        $users = User::all(); // Lấy danh sách người dùng để chọn trong trường "áp dụng cho"
        return view('viewAdmin.edit_vocher', compact('vocher', 'users'));
    }
    public function update(Request $request, $id)
    {
        $vocher = Vocher::findOrFail($id);

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