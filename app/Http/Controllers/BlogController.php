<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy tất cả các bài viết blog
        // $blogs = Blog::all();
        
        // Lấy 6 bài viết blog mỗi trang
        $blogs = Blog::paginate(6);

        // Truyền dữ liệu tới view hiển thị danh sách blog
        return view('viewUser.blog_list', compact('blogs'));
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
