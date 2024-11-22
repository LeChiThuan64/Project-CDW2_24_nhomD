<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Product; // Model Product
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    // Hiển thị wishlist

    public function index()
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        $user = Auth::user();
    
        if ($user) {
            // Lấy tất cả wishlist items của người dùng đã đăng nhập
            $wishlistItems = Wishlist::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->paginate(6);
    
            // Sử dụng map để thêm thông tin sản phẩm, hình ảnh, và giá vào wishlist
            $wishlistItems->getCollection()->transform(function ($wishlistItem) {
                $wishlistItem->product = Product::with(['images', 'productSizeColors'])->find($wishlistItem->product_id);
    
                if ($wishlistItem->product && $wishlistItem->product->productSizeColors->isNotEmpty()) {
                    $price = $wishlistItem->product->productSizeColors->first()->price;
                    $wishlistItem->price = $price;
                } else {
                    $wishlistItem->price = null;
                }
                $wishlistItem->image = optional($wishlistItem->product->images->first())->image_url ?? null;
    
                return $wishlistItem;
            });
        } else {
            $wishlistItems = collect(); // Nếu chưa đăng nhập, tạo một collection rỗng
        }
    
        return view('viewUser.wishlist', compact('wishlistItems'));
    }
    

// Thêm sản phẩm vào wishlist
public function add($productId)
{
    $user = Auth::user();

    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'You need to login to add product to wishlist'
        ], 401); // 401 Unauthorized
    }

    $product = Product::find($productId);
    Log::info('Product ID: ' . $productId);

    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ], 404); // 404 Not Found
    }

    // Kiểm tra xem sản phẩm đã có trong wishlist chưa
    if ($user->wishlists()->where('product_id', $productId)->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'Product is already in your wishlist'
        ], 400); // 400 Bad Request
    }

    // Thêm sản phẩm vào wishlist
    $user->wishlists()->create(['product_id' => $productId]);

    return response()->json([
        'success' => true,
        'message' => 'Add to wishlist successfully!'
    ], 200); // 200 OK
}

public function remove($wishlistId)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json(['error' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi wishlist.'], 403);
    }

    $wishlistItem = $user->wishlists()->where('id', $wishlistId)->first();

    if (!$wishlistItem) {
        return redirect()->back()->with('error', 'Sản phẩm không có trong wishlist.');
    }

    // Xóa sản phẩm khỏi wishlist
    $wishlistItem->delete();

    return redirect()->back()->with('delete-wishlist-success', 'Delete from wishlist successfully!');
}

}

