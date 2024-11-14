<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use App\Models\ProductSizeColor;
use App\Models\Product;
use App\Models\ShippingPrice;

class CartController extends Controller
{


public function show(Request $request)
{

    $user_id = Auth::id();

    if (!$user_id) {
        return redirect()->route('auth')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
    }

    $cartItems = CartItem::with(['product.images', 'size', 'color'])
        ->whereHas('cart', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })
        ->get();

    $cart = $cartItems->map(function ($item) {
        $product = $item->product;
        $images = $product->images->pluck('image_url')->toArray();

        return [
            'cart_item_id' => $item->cart_item_id,
            'product_id' => $product->product_id,
            'name' => $product->name,
            'description' => $product->description,
            'quantity' => $item->quantity,
            'images' => $images,
            'size' => optional($item->size)->name,
            'color' => optional($item->color)->name,
            'price' => $item->getPrice(),
        ];
    })->toArray();

    // Tính tổng số tiền
    $total = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // Lấy danh sách voucher
    $vouchers = Voucher::where('is_global', true)
        ->orWhere('user_id', $user_id)
        ->get();

    // Lấy danh sách shipping price
    $shippingprice = ShippingPrice::all();

    return view('viewUser.cart', [
        'cart' => $cart,
        'vouchers' => $vouchers,
        'shippingprice' => $shippingprice,
        'total' => $total,
    ]);

}

// Thêm sản phẩm vào giỏ hàng
public function add(Request $request, $productId)
{
    $user_id = Auth::id();

    if (!$user_id) {
        return redirect()->route('auth')->with('error', 'Bạn cần đăng nhập để xem giỏ hàng.');
    }


    $request->validate([
        'quantity' => 'required|integer|min:1',
        'size_id' => 'required|exists:sizes,id',
        'color_id' => 'required|exists:colors,id',
    ]);


    $cart = Cart::firstOrCreate(['user_id' => $user_id]);

    $cartItem = CartItem::where('cart_id', $cart->cart_id)
        ->where('product_id', $productId)
        ->where('size_id', $request->size_id)
        ->where('color_id', $request->color_id)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += $request->quantity;
        $cartItem->save();
    } else {
        CartItem::create([
            'cart_id' => $cart->cart_id,
            'product_id' => $productId,
            'size_id' => $request->size_id,
            'color_id' => $request->color_id,
            'quantity' => $request->quantity,
        ]);
    }
    return redirect()->route('cart.show')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}

public function remove($cartItemId)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng.'], 403);
    }

    $cartItem = CartItem::where('cart_item_id', $cartItemId)->first();

    if ($cartItem) {
        $cartItem->delete();
        return response()->json(['success' => true, 'message' => 'Item removed from cart']);
    }

    return response()->json(['success' => false, 'message' => 'Item not found'], 404);
}


public function update(Request $request)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Bạn cần đăng nhập để cập nhật giỏ hàng.'], 403);
    }

    $updatedData = $request->input('updatedData');

    foreach ($updatedData as $data) {
        $cartItem = CartItem::find($data['cart_item_id']);

        if ($cartItem) {
            $cartItem->quantity = $data['quantity'];
            $cartItem->save();
        }
    }

    return response()->json(['message' => 'Cart updated successfully']);
}

public function clear()
{
    // Xóa tất cả sản phẩm ra khỏi giỏ hàng trong cơ sở dữ liệu
    CartItem::truncate();
    return response()->json(['success' => true]);
}
    

}