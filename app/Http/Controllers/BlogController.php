<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


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
            return view('viewUser.blog_list', compact('blogs'))->render();
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
        // Kiểm tra nếu user hiện tại không phải admin
        if (auth()->user()->role == 1) {
            return redirect()->route('admin.blog.index')->with('error', 'Chỉ admin mới có quyền xóa blog.');
        }
    
        // Tìm blog theo blog_id và xóa nó
        $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
        $blog->delete();
    
        // Chuyển hướng với thông báo thành công
        return redirect()->route('admin.blog.index')->with('success', 'Blog đã được xóa thành công!');
    }
    

    // public function edit($blog_id)
    // {
    //     // Lấy blog cần sửa
    //     $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
    //     return view('viewAdmin.sua_blog', compact('blog'));
    // }

    // public function edit($encryptedBlogId)
    // {
    //     // Giải mã ID blog
    //     $blog_id = Crypt::decryptString($encryptedBlogId);

    //     // Lấy blog cần sửa
    //     $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
    //     return view('viewAdmin.sua_blog', compact('blog'));
    // }

    public function edit($encryptedBlogId)
    {
        try {
            // Giải mã ID blog
            $blog_id = Crypt::decryptString($encryptedBlogId);

            // Lấy blog cần sửa
            $blog = Blog::where('blog_id', $blog_id)->firstOrFail();
            return view('viewAdmin.sua_blog', compact('blog'));
        } catch (DecryptException $e) {
            // Trả về thông báo lỗi nếu mã hóa không hợp lệ
            return redirect()->route('admin.blog.index')->with('error', 'ID blog không hợp lệ.');
        }
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

        // Tăng số lượt xem lên 1
        $blog->increment('views');

        // Truyền blog và comments tới view
        return view('viewUser.blogs_Detal', compact('blog', 'comments'));
    }

    //comemnt của comment
    public function storeComment(Request $request, $blog_id)
    {
        // Validate dữ liệu bình luận
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id', // Kiểm tra xem parent_id có hợp lệ không
        ]);

        // Lưu bình luận hoặc phản hồi vào cơ sở dữ liệu và gán user_id
        Comment::create([
            'blog_id' => $blog_id,
            'user_id' => auth()->id(), // Lưu user_id của người dùng hiện tại
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'parent_id' => $request->parent_id, // Gán parent_id nếu có
        ]);

        // Chuyển hướng về trang chi tiết blog với bình luận mới
        return redirect()->route('blog.detail', ['blog_id' => $blog_id])->with('success', 'Comment added successfully');
    }

    // đếm comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function deleteComment($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        // Kiểm tra nếu người dùng hiện tại là tác giả của bình luận
        if ($comment->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Bình luận đã được xóa thành công');
    }
}
