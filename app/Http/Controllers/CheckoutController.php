<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\ShippingPrice;
use App\Models\Voucher; 
use App\Models\BankAccount; // Import model BankAccount
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {
        $user_id = Auth::id();

        if (!$user_id) {
            return redirect()->route('auth')->with('error', 'Bạn cần đăng nhập để thanh toán.');
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

        // Lấy danh sách phương thức vận chuyển
        $shippingprice = ShippingPrice::all();

        // Lấy danh sách tài khoản ngân hàng
        $bankAccounts = BankAccount::where('user_id', $user_id)->get();
        
        return view('viewUser.checkout', [
            'cart' => $cart,
            'total' => $total,
            'vouchers' => $vouchers,
            'shippingprice' => $shippingprice,
            'bankAccounts' => $bankAccounts
        ]);
    }
}