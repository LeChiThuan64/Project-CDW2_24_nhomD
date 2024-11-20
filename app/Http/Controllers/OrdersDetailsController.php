<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class OrdersDetailsController extends Controller
{
    public function show($id)
    {
        // Lấy thông tin chi tiết đơn hàng từ cơ sở dữ liệu
        $order = Order::with('orderItems.product')->findOrFail($id);

        // Truyền dữ liệu vào view
        return view('viewUser.order_details', compact('order'));
    }
    public function update(Request $request, $id)
    {
        // Lấy thông tin đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($id);

        // Cập nhật thông tin đơn hàng
        $order->update([
            'street_address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        return response()->json(['success' => true]);
    }
    public function resendOrder($id)
    {
        try {
            // Tìm đơn hàng theo ID, ném ngoại lệ nếu không tìm thấy
            $order = Order::findOrFail($id);

            // Thay đổi trạng thái đơn hàng sang "pending"
            $order->status = 'pending';

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã được gửi lại thành công.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng.'
            ]);
        }
    }
}