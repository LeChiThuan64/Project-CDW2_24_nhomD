<?php
// app/Http/Controllers/ReturnsOrderAdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnsOrder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\ProductSizeColor;
use Illuminate\Support\Facades\Log;

class ReturnsOrderAdminController extends Controller
{
    public function index()
    {
        $returnsOrders = ReturnsOrder::all();
        return view('viewAdmin.returns_order_admin', compact('returnsOrders'));
    }

    public function productReceived(Request $request, $orderId)
    {
        try {
            // Lấy thông tin sản phẩm từ orders_items
            $orderItem = OrderItem::where('order_id', $orderId)->firstOrFail();
            $productSizeColor = ProductSizeColor::where('product_id', $orderItem->product_id)
                ->where('size_id', $orderItem->size_id)
                ->where('color_id', $orderItem->color_id)
                ->firstOrFail();

            // Cập nhật số lượng sản phẩm trong product_size_color
            $productSizeColor->quantity += $orderItem->quantity;
            $productSizeColor->save();

            // Lấy giá sản phẩm từ orderItem
            $productPrice = $orderItem->price;

            // Cập nhật subtotal và total trong orders
            $order = Order::findOrFail($orderId);
            $order->subtotal -= $productPrice;
            $order->total -= $productPrice;
            $order->save();

            // Cập nhật trạng thái trong returns_orders
            $returnsOrder = ReturnsOrder::where('orders_id', $orderId)->firstOrFail();
            $returnsOrder->status = 'Đã xử lý xong';
            $returnsOrder->save();

            // Xóa sản phẩm khỏi orders_items
            $orderItem->delete();

            Log::info('Product received and updated successfully', ['order_id' => $orderId]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error handling product received', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}