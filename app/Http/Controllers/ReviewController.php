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


}
