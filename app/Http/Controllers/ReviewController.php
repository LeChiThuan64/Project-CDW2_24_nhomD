<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    //
    public function show()
    {
        $reviews = Review::paginate(5);
        return view('viewAdmin.list_reviews', compact('reviews'));
    }

    public function destroy(Request $request, $id)
    {
        $review = Review::find($id);
        if ($review) {
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
