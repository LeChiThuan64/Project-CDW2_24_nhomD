<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    //
    public function show(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ người dùng
        $search = $request->input('search');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($search) {
            // Tìm kiếm reviews theo user name, product name hoặc rating
            $reviews = Review::select('reviews.*')
                // Thực hiện JOIN với bảng users và products để truy vấn tên của user và sản phẩm
                ->join('users', 'reviews.user_id', '=', 'users.id')
                ->join('products', 'reviews.product_id', '=', 'products.product_id')
                ->where(function ($query) use ($search) {
                    $query->where('users.name', 'like', '%' . $search . '%') // Tìm kiếm theo user name
                        ->orWhere('products.name', 'like', '%' . $search . '%') // Tìm kiếm theo product name
                        ->orWhere('reviews.rating', 'like', '%' . $search . '%')
                        ->orWhereRaw("MATCH(users.name) AGAINST(? IN BOOLEAN MODE)", [$search])
                        ->orWhereRaw("MATCH(products.name) AGAINST(? IN BOOLEAN MODE)", [$search]);
                })
                ->paginate(5);
        } else {
            // Nếu không có từ khóa tìm kiếm, hiển thị tất cả reviews
            $reviews = Review::orderBy('created_at', 'desc')->paginate(5);
        }

        // Trả về view chính
        return view('viewAdmin.list_reviews', compact('reviews'));
    }


    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);
        if ($review) {
            $review->images()->delete();
            $review->delete();
            $request->session()->flash('delete-success', 'Delete review successfully!');
            return redirect()->route('review.show');
        }
        $request->session()->flash('delete-failure', 'This review is not found!');
        return redirect()->route('review.show');
    }

    public function store(Request $request, $review_id)
    {
        $request->validate(['reply' => 'required|string']);

        // Tìm review theo id
        $review = Review::findOrFail($review_id);

        // Cập nhật hoặc thêm mới reply
        $review->reply = $request->reply;
        $review->save();

        // Thêm flash message
        $message = $review->wasChanged('reply') ? "Reply updated successfully!" : "Reply added successfully!";
        $request->session()->flash('add-reply-success', $message);

        return back();
    }
    
    public function destroyByUser(Request $request, $id)
    {
        // Tìm đánh giá theo ID
        $review = Review::find($id);

        // Kiểm tra xem đánh giá có tồn tại và người dùng có quyền xóa không
        if ($review && $review->user_id === auth()->id()) {
            try {
                // Xóa các hình ảnh liên quan
                $review->images()->delete();
                // Xóa đánh giá
                $review->delete();

                // Kiểm tra nếu là AJAX request
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Delete review successfully!',
                    ]);
                }

                // Nếu không phải AJAX, redirect về trang review
                $request->session()->flash('delete-success', 'Delete review successfully!');
                return redirect()->route('reviews.index');
            } catch (\Exception $e) {
                // Xử lý lỗi nếu có
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Đã xảy ra lỗi khi xóa đánh giá.',
                    ], 500);
                }

                // Nếu không phải AJAX, thông báo lỗi
                $request->session()->flash('delete-failure', 'Đã xảy ra lỗi khi xóa đánh giá!');
                return redirect()->route('reviews.index');
            }
        }

        // Nếu không tìm thấy review hoặc người dùng không có quyền xóa
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đánh giá hoặc bạn không có quyền xóa.',
            ], 404);
        }

        // Nếu không phải AJAX, trả về thông báo lỗi
        $request->session()->flash('delete-failure', 'Không tìm thấy đánh giá hoặc bạn không có quyền xóa!');
        return redirect()->route('reviews.index');
    }

}
