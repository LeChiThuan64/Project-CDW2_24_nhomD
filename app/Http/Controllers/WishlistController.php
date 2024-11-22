<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\OrderItem;
use App\Models\Product;
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
                ->whereHas('product')
                ->orderBy('created_at', 'desc')
                ->paginate(6);
    
            // Sử dụng map để thêm thông tin sản phẩm, hình ảnh, và giá vào wishlist
            $wishlistItems->getCollection()->transform(function ($wishlistItem) {
                $wishlistItem->product = Product::with(['images', 'productSizeColors', 'reviews'])->find($wishlistItem->product_id);
    
                foreach ($wishlistItem->product->productSizeColors as $sizeColor) {   // Cộng tổng số lượng
                    $wishlistItem->price = $sizeColor->price;                     // Lấy giá (giả sử giá là giống nhau cho tất cả sizeColor)
                }


                
                $wishlistItem->image = optional($wishlistItem->product->images->first())->image_url ?? null;
    
                $wishlistItem->reviewCount = $wishlistItem->product->reviews->count();
                $wishlistItem->averageRating = $wishlistItem->product->reviews->avg('rating') ?? 0;
                $wishlistItem->totalSold = OrderItem::where('product_id', $wishlistItem->product_id)->sum('quantity') ?? 0;

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

    // if (!$user) {
    //     return redirect()->back()->with('error', 'You need to login to remove product from wishlist.');
    // }

    $wishlistItem = $user->wishlists()->where('id', $wishlistId)->first();

    if (!$wishlistItem) {
        return redirect()->back()->with('error', 'This product is not in wishlist!');
    }

    // Xóa sản phẩm khỏi wishlist
    $wishlistItem->delete();

    return redirect()->back()->with('success', 'Removed from wishlist successfully!');
}

public function toggle(Request $request, $productId)
{
    $user = Auth::user();

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'You need to login to manage wishlist'
        ], 401);
    }

    $product = Product::find($productId);

    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found'
        ], 404);
    }

    $wishlistItem = $user->wishlists()->where('product_id', $productId)->first();

    if ($wishlistItem) {
        // Nếu đã có, xóa khỏi wishlist
        $wishlistItem->delete();
        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist successfully!'
        ], 200);
    } else {
        // Nếu chưa có, thêm vào wishlist
        $user->wishlists()->create(['product_id' => $productId]);
        return response()->json([
            'success' => true,
            'message' => 'Added to wishlist successfully!'
        ], 200);
    }
}

}

