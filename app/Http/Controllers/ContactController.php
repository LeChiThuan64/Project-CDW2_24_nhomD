<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Thêm dòng này
use App\Models\ContactMessage; // Nếu bạn tạo model cho contact_messages

class ContactController extends Controller
{
    // public function index()
    // {
    //     $messages = ContactMessage::all(); // Lấy tất cả tin nhắn từ bảng contact_messages
    //     return view('viewAdmin.contact_admin', compact('messages')); // Truyền biến $messages vào view
    // }
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $search = $request->input('search');

        // Nếu có từ khóa tìm kiếm, áp dụng bộ lọc, ngược lại lấy toàn bộ dữ liệu
        $messages = ContactMessage::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('message', 'like', "%{$search}%");
        })->get(); // Lấy toàn bộ dữ liệu, không phân trang

        // Trả về view với dữ liệu $messages
        return view('viewAdmin.contact_admin', compact('messages'));
    }



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

    // public function __construct()
    // {
    //     $this->middleware('auth')->except('store');
    // }

    public function destroy($id)
    {
        // Tìm và xóa tin nhắn theo id
        ContactMessage::findOrFail($id)->delete();

        // Chuyển hướng lại trang contact admin với thông báo thành công
        return redirect()->route('contact.index')->with('success', 'Tin nhắn đã được xóa thành công!');
    }
}
