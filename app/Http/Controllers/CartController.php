<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Voucher;
use App\Models\ProductSizeColor;
use App\Models\Product;

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

    // Lấy danh sách voucher
    $vouchers = Voucher::where('is_global', true)
        ->orWhere('user_id', $user_id)
        ->get();

    return view('viewUser.cart', [
        'cart' => $cart,
        'vouchers' => $vouchers,
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

    $productSizeColor = ProductSizeColor::where('product_id', $productId)
        ->where('size_id', $request->size_id)
        ->where('color_id', $request->color_id)
        ->first();

        if ($productSizeColor->quantity < $request->quantity) {
            return response()->json(['error' => 'Số lượng sản phẩm không đủ để thêm vào giỏ hàng.'], 400);
        }

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
    $productSizeColor->quantity -= $request->quantity;
    $productSizeColor->save();

    return redirect()->route('cart.show')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}

public function remove($cartItemId)
{
    if (!Auth::check()) {
        return response()->json(['error' => 'Bạn cần đăng nhập để xóa sản phẩm khỏi giỏ hàng.'], 403);
    }

    $cartItem = CartItem::where('cart_item_id', $cartItemId)->first();

    if ($cartItem) {
        // Lấy thông tin sản phẩm từ bảng CartItem
        $productId = $cartItem->product_id;
        $sizeId = $cartItem->size_id;
        $colorId = $cartItem->color_id;
        $quantity = $cartItem->quantity;

        // Cộng lại số lượng sản phẩm trong bảng sản phẩm (hoặc bảng trung gian)
        $productSizeColor = ProductSizeColor::where('product_id', $productId)
        ->where('size_id', $sizeId)
        ->where('color_id', $colorId)
        ->first();

        $productSizeColor->quantity += $quantity;
        $productSizeColor->save();
        // Xóa CartItem khỏi giỏ hàng
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
            $oldQuantity = $cartItem->quantity;
            $newQuantity = $data['quantity'];

            // Update the CartItem quantity
            $cartItem->quantity = $newQuantity;
            $cartItem->save();

            // Get the ProductSizeColor record for the current item
            $productSizeColor = ProductSizeColor::where('product_id', $cartItem->product_id)
                ->where('size_id', $cartItem->size_id)
                ->where('color_id', $cartItem->color_id)
                ->first();

            // Adjust the ProductSizeColor quantity
            if ($productSizeColor) {
                if ($newQuantity > $oldQuantity) {
                    // If quantity is increased, reduce from the ProductSizeColor quantity
                    $productSizeColor->quantity -= ($newQuantity - $oldQuantity);
                } elseif ($newQuantity < $oldQuantity) {
                    // If quantity is decreased, add to the ProductSizeColor quantity
                    $productSizeColor->quantity += ($oldQuantity - $newQuantity);
                }
                $productSizeColor->save();
            }
        }
    }

    return response()->json(['message' => 'Giỏ hàng đã được cập nhật thành công']);
}


    

}
