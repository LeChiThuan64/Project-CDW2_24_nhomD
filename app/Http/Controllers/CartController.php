<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    // public function show(Request $request)
    // {
    //     if (Auth::check()) {
    //         // Lấy giỏ hàng từ cơ sở dữ liệu cho người dùng đã đăng nhập
    //         $cartItems = CartItem::with([
    //             'product.images',
    //             'product.productSizeColors.size',
    //             'product.productSizeColors.color'
    //         ])
    //             ->where('user_id', $request->user()->id)
    //             ->get();

    //         // Chuyển đổi dữ liệu từ cơ sở dữ liệu thành định dạng mong muốn
    //         $cart = $cartItems->map(function ($item) {
    //             $product = $item->product;

    //             // Lấy danh sách hình ảnh của sản phẩm
    //             $images = $product->images->pluck('image_url')->toArray();

    //             // Lấy thông tin kích thước và màu sắc cùng với thông tin từ bảng trung gian
    //             $sizesAndColors = $product->productSizeColors->map(function ($sizeColor) {
    //                 return [
    //                     'size' => optional($sizeColor->size)->name,
    //                     'color' => optional($sizeColor->color)->name,
    //                     'quantity' => $sizeColor->pivot->quantity,
    //                     'price' => $sizeColor->pivot->price,
    //                 ];
    //             });

    //             return [
    //                 'product_id' => $product->product_id,
    //                 'name' => $product->name,
    //                 'description' => $product->description,
    //                 'quantity' => $item->quantity,
    //                 'images' => $images,
    //                 'sizesAndColors' => $sizesAndColors,
    //             ];
    //         })->toArray();
    //     } else {
    //         // // Nếu người dùng chưa đăng nhập, lấy dữ liệu từ cookie
    //         // if (Cookie::get('cart')) {
    //         //     $cart = json_decode(Cookie::get('cart'), true);
    //         // } else {
    //         //     $cart = [];
    //         // }
    //     }

    //     // Hiển thị trang giỏ hàng với dữ liệu từ cookie hoặc cơ sở dữ liệu
    //     return view('viewUser.cart', ['cart' => $cart]);
    // }
    public function show(Request $request)
    {
        // Gán tạm user_id = 1 để kiểm tra chức năng
        $user_id = 1;

        // Lấy giỏ hàng từ cơ sở dữ liệu cho người dùng với user_id đã gán
        $cartItems = CartItem::with([
            'product.images',
            'product.productSizeColors.size',
            'product.productSizeColors.color'
        ])
            ->whereHas('cart', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();

        // Chuyển đổi dữ liệu từ cơ sở dữ liệu thành định dạng mong muốn
        $cart = $cartItems->map(function ($item) {
            $product = $item->product;

            // Lấy danh sách hình ảnh của sản phẩm
            $images = $product->images->pluck('image_url')->toArray();

            // Lấy thông tin kích thước và màu sắc cùng với thông tin từ bảng trung gian
            $sizesAndColors = $product->productSizeColors->map(function ($sizeColor) {
                return [
                    'size' => optional($sizeColor->size)->name,
                    'color' => optional($sizeColor->color)->name,
                    // 'price' => $sizeColor->pivot->price,
                ];
            });

            return [
                'cart_item_id' => $item->cart_item_id,
                'product_id' => $product->product_id,
                'name' => $product->name,
                'description' => $product->description,
                'quantity' => $item->quantity,
                'images' => $images,
                'sizesAndColors' => $sizesAndColors,
                'price' => $item->getPrice(),
            ];
        })->toArray();

        // Hiển thị trang giỏ hàng với dữ liệu
        return view('viewUser.cart', ['cart' => $cart]);
    }


    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $productId)
    {
        // Xác thực rằng số lượng sản phẩm là một số nguyên dương
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Tìm hoặc tạo giỏ hàng cho người dùng
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        // Tìm sản phẩm trong giỏ hàng
        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có, thêm mới
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $productId,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function remove($cartItemId)
    {
        try {
            $cartItem = CartItem::where('cart_item_id',$cartItemId);
            $cartItem->delete();

            return response()->json(['success' => true, 'message' => 'Item removed from cart']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to remove item from cart'], 500);
        }
    }

    public function update(Request $request, $cartItemId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1', // Đảm bảo số lượng hợp lệ
    ]); 

     // Xử lý logic cập nhật giỏ hàng
     $quantities = $request->input('quantity');

     foreach ($quantities as $cartItemId => $quantity) {

         $cartItem = CartItem::find($cartItemId);
         if ($cartItem) {
             $cartItem->quantity = $quantity;
             $cartItem->save();
         }
     }
 
     // Trả về phản hồi JSON
     return response()->json(['success' => true, 'message' => 'Cart updated successfully!']);
}

}