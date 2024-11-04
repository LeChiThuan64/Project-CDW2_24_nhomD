<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Product; // Model Product
use Auth; // Để sử dụng Authentication
use DB;

class WishlistController extends Controller
{
    // Hiển thị wishlist
    public function index()
{
    // Giả lập người dùng đã đăng nhập
    $user = User::find(1); // Thay thế bằng Auth::user() nếu bạn muốn sử dụng người dùng đã đăng nhập

    // Kiểm tra xem người dùng đã đăng nhập chưa
    if ($user) {
        // Lấy tất cả wishlist items của người dùng
        $wishlistItems = Wishlist::where('user_id', $user->id)->get();

        // Sử dụng map để thêm thông tin sản phẩm và hình ảnh vào wishlist
        $wishlistItems = $wishlistItems->map(function ($wishlistItem) {
            $wishlistItem->product = Product::with('images')->find($wishlistItem->product_id); // Lấy sản phẩm và mối quan hệ images
            return $wishlistItem;
        });
    } else {
        $wishlistItems = collect(); // Nếu chưa đăng nhập, tạo một collection rỗng
    }

    return view('viewUser.wishlist', compact('wishlistItems')); // Truyền dữ liệu vào view
}


    // Thêm sản phẩm vào wishlist
    public function add($productId)
    {
        // $user = Auth::user();
        $user = User::find(1);
        // Kiểm tra xem người dùng có đăng nhập hay không
        if (!$user) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào wishlist.');
        }

        $product = Product::findOrFail($productId);

        // Thêm sản phẩm vào wishlist
        $user->wishlists()->create(['product_id' => $productId]);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào wishlist!');
    }

    public function remove($wishlistId)
{
    // Tìm user mặc định (hoặc bạn có thể dùng Auth::user())
    $user = User::find(1);

    $user = User::find(1);

if (!$user) {
    return response()->json(['error' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi wishlist.'], 403);
}

// Tìm sản phẩm trong danh sách wishlist của người dùng
$wishlistItem = $user->wishlists()->where('id', $wishlistId)->first();

if (!$wishlistItem) {
    return redirect()->back()->with('error', 'Sản phẩm không có trong wishlist.');
}

// Xóa sản phẩm khỏi wishlist
$wishlistItem->delete();

return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi wishlist!');
}

}

