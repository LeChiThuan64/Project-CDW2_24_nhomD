<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Voucher;
class CheckoutConfirmation extends Controller
{
    public function show($orderId)
    {
        // Lấy thông tin đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($orderId);
        // Lấy thông tin các sản phẩm trong đơn hàng
        $orderItems = OrderItem::with('product')->where('order_id', $orderId)->get();
        // Lấy thông tin voucher nếu có
        $voucher = null;
        if ($order->voucher_id) {
            $voucher = Voucher::find($order->voucher_id);
        }

        // Truyền dữ liệu vào view
        return view('viewUser.confirmation_checkout',compact('order', 'orderItems','voucher'));
    }
}