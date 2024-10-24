<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();
        $queryText = $request->input('query');

        if ($queryText) {
            $query->where('title', 'like', '%' . $queryText . '%')
                ->orWhere('blog_id', $queryText); // Sử dụng 'blog_id' thay vì 'id'
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(6);

        if ($request->ajax()) {
            return view('viewUser.blog_list_ajax', compact('blogs'))->render();
        }

        return view('viewUser.blog_list', compact('blogs'));
    }

    // Admin blog index
    public function adminIndex(Request $request)
    {
        $query = Blog::query();
        $queryText = $request->input('query');

        if ($queryText) {
            $query->where('title', 'like', '%' . $queryText . '%')
                ->orWhere('blog_id', $queryText);
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('viewAdmin.blogs_admin', compact('blogs'));
    }

    // thêm sql
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024', // Hạn chế dung lượng và định dạng
        ]);
    
        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            // Lưu file ảnh vào thư mục 'uploads' trong 'storage/app/public'
            $path = $request->file('image')->store('uploads', 'public');
        } else {
            $path = null; // Không có ảnh tải lên
        }
    
        // Tạo một blog mới
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->image_url = $path; // Lưu đường dẫn ảnh nếu có
        $blog->save();
    
        // Chuyển hướng về trang danh sách blog với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Blog đã được thêm thành công!');
    }
    


    public function destroy($blog_id)
    {
        // Tìm blog theo blog_id và xóa nó
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
        $blog->delete();

        // Chuyển hướng với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Blog đã được xóa thành công!');
    }


    public function show($blog_id)
    {
        // Lấy blog theo blog_id
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();

        // Lấy tất cả các bình luận liên quan đến blog này
        $comments = $blog->comments;  // Đảm bảo rằng $comments không phải null

        // Truyền blog và comments tới view
        return view('viewUser.blogs_Detal', compact('blog', 'comments'));
    }


    public function storeComment(Request $request, $blog_id)
    {
        // Validate dữ liệu bình luận
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        // Lưu bình luận vào cơ sở dữ liệu
        Comment::create([
            'blog_id' => $blog_id,
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        // Chuyển hướng về trang chi tiết blog với bình luận mới
        return redirect()->route('blog.detail', ['blog_id' => $blog_id])->with('success', 'Comment added successfully');
    }
}
