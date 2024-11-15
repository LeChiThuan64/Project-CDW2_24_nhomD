<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductSizeColor;
use App\Models\Voucher;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Tạo ID ngẫu nhiên
        $orderId = $this->generateUniqueOrderId();
        // Lấy giá trị discount từ bảng vouchers dựa vào voucher_id
        $voucherDiscount = null;
        if ($request->voucher_id) {
            $voucher = Voucher::find($request->voucher_id);
            if ($voucher) {
                $voucherDiscount = $voucher->discount;
            }
        }

        $order = Order::create([
            'id' => $orderId, // Sử dụng ID ngẫu nhiên
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country' => $request->country,
            'street_address' => $request->street_address,
            'city' => $request->city,
            'zipcode' => $request->zipcode,
            'phone' => $request->phone,
            'email' => $request->email,
            'subtotal' => $request->subtotal,
            'shipping_price' => $request->shipping_price,
            'total' => $request->total,
            'payment_method' => $request->payment_method,
            'voucher_discount' => $voucherDiscount,
            'note' => $request->note,
        ]);

        foreach ($request->order_items as $item) {
            if (!isset($item['size_id']) || !isset($item['color_id'])) {
                return response()->json(['error' => 'Missing size_id or color_id'], 400);
            }

            $productSizeColor = ProductSizeColor::where('product_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->where('color_id', $item['color_id'])
                ->first();

            if (!$productSizeColor) {
                return response()->json(['error' => 'Product Size Color not found'], 404);
            }
            // Kiểm tra số lượng tồn kho
            if ($productSizeColor->quantity < $item['quantity']) {
                $productName = $productSizeColor->product->name; // Giả sử bạn có mối quan hệ product trong model ProductSizeColor
                return response()->json(['error' => "Sản phẩm {$productName} vượt quá số lượng tồn kho. Vui lòng chọn lại!"], 400);
            }

            // Trừ số lượng trong bảng product_size_color
            $productSizeColor->quantity -= $item['quantity'];
            $productSizeColor->save();

            // Ghi lại giá trị trước khi chèn vào cơ sở dữ liệu
            Log::info('Order Item Data:', [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'size_id' => $item['size_id'],
                'color_id' => $item['color_id'],
                'quantity' => $item['quantity'],
                'price' => $productSizeColor->price * $item['quantity'],
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'size_id' => $item['size_id'],
                'color_id' => $item['color_id'],
                'quantity' => $item['quantity'],
                'price' => $productSizeColor->price * $item['quantity'],
            ]);
            
        }

        // Xóa voucher khỏi hệ thống nếu có sử dụng voucher
        if ($request->voucher_id) {
            Voucher::where('id', $request->voucher_id)->delete();
        }

        return response()->json(['success' => true, 'order_id' => $order->id]);
    }
    // Random id khi được tạo ra
    private function generateUniqueOrderId()
    {
        do {
            $orderId = rand(1000, 9999);
        } while (Order::where('id', $orderId)->exists());

        return $orderId;
    }
}