<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    //
    public function show()
    {
        // Lấy giỏ hàng của người dùng hiện tại
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();

        // Kiểm tra xem giỏ hàng có tồn tại không
        if (!$cart) {
            return view('viewUser.cart', ['items' => [], 'total' => 0]);
        }

        // Tính tổng số tiền trong giỏ hàng
        $total = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity; // Giả sử bạn có thuộc tính price trong Product
        });

        // Trả về view giỏ hàng với danh sách sản phẩm
        return view('viewUser.cart', [
            'items' => $cart->items,
            'total' => $total,
        ]);
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
}
