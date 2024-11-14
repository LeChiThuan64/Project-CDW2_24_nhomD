<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\productSizeColor;
use Illuminate\Support\Facades\Log; // Thêm dòng này

class OrderItemController extends Controller
{
    public function show($cartItemId)
    {
        $cartItem = CartItem::with('product')->find($cartItemId);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        $productSizeColor = ProductSizeColor::where('product_id', $cartItem->product_id)
            ->where('size_id', $cartItem->size_id)
            ->where('color_id', $cartItem->color_id)
            ->first();

        if (!$productSizeColor) {
            return response()->json(['error' => 'Product Size Color not found'], 404);
        }

        $products = collect([$cartItem->product])->map(function($product) use ($cartItem, $productSizeColor) {
            return [
                'product_id' => $product->product_id,
                'size_id' => $cartItem->size_id,
                'color_id' => $cartItem->color_id,
                'quantity' => $cartItem->quantity,
                'price' => $productSizeColor->price
            ];
        });

        return response()->json(['products' => $products]);
    }
}