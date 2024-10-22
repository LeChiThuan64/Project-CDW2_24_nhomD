<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy tất cả các bài viết blog từ cơ sở dữ liệu
        $blogs = Blog::all();

        // Truyền dữ liệu đến view
        return view('viewUser.blog_list', compact('blogs'));
    }
    public function show($blog_id)
    {
        // Tìm blog theo blog_id
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();

        // Truyền blog tới view chi tiết
        return view('viewUser.blogs_Detal', compact('blog'));
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
