<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use Carbon\Carbon;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            // Lưu file ảnh trực tiếp vào thư mục public/uploads
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $path = 'uploads/' . $imageName;
        } else {
            $path = null;
        }

        // Tạo một blog mới
        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->image_url = $path; // Lưu đường dẫn ảnh
        $blog->save();

        // Chuyển hướng về trang danh sách blog với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Blog đã được thêm thành công!');
    }

    public function uploadImage(Request $request)
    {
        $imageData = $request->input('image');

        // Kiểm tra ảnh có đúng định dạng base64 không
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            $data = substr($imageData, strpos($imageData, ',') + 1);
            $data = base64_decode($data);
            $imageName = time() . '.png';
            $path = public_path('uploads') . '/' . $imageName;
            file_put_contents($path, $data);

            // Trả về URL của ảnh đã lưu
            return response()->json(['url' => asset('uploads/' . $imageName)]);
        }

        return response()->json(['error' => 'Invalid image data'], 400);
    }



    public function destroy($blog_id)
    {
        // Tìm blog theo blog_id và xóa nó
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
        $blog->delete();

        // Chuyển hướng với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Blog đã được xóa thành công!');
    }

    public function edit($blog_id)
    {
        // Lấy blog cần sửa
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
        return view('viewAdmin.sua_blog', compact('blog'));
    }

    public function update(Request $request, $blog_id)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        // Tìm blog để cập nhật
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();

        // Xử lý upload ảnh nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $imageName);
            $path = 'uploads/' . $imageName;
            $blog->image_url = $path;
        }

        // Cập nhật các thông tin khác
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');
        $blog->save();

        // Chuyển hướng về trang danh sách blog với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Blog đã được cập nhật thành công!');
    }



    public function show($blog_id)
    {
        // Lấy blog theo blog_id
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();

        // Lấy tất cả các bình luận liên quan đến blog này
        $comments = $blog->comments;  // Đảm bảo rằng $comments không phải null

        // Lấy ngày giờ hiện tại
        $currentDateTime = Carbon::now()->locale('vi')->isoFormat('DD/MM/YYYY, HH:mm');

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
