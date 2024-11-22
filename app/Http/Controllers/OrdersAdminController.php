<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderFail;

class OrdersAdminController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng từ cơ sở dữ liệu
        $orders = Order::orderBy('created_at', 'desc')->get();

        // Truyền dữ liệu vào view
        return view('viewAdmin.orders_admin', compact('orders'));
    }
    public function confirmOrder(Request $request, $id)
    {
        // Lấy thông tin đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($id);

        // Cập nhật trạng thái đơn hàng
        $order->update([
            'status' => 'on delivery'
        ]);

        return response()->json(['success' => true]);
    }
    public function reportError(Request $request, $id)
    {
        // Lấy thông tin đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($id);

        // Lưu thông tin lỗi vào bảng order_fails
        OrderFail::create([
            'order_id' => $order->id,
            'error_type' => $request->errorType,
            'error_description' => $request->errorDescription,
        ]);

        // Cập nhật trạng thái đơn hàng
        $order->update([
            'status' => 'order fails'
        ]);

        return response()->json(['success' => true]);
    }
    public function deleteOrder($id)
    {
        try {
            // Tìm đơn hàng theo ID, ném ngoại lệ nếu không tìm thấy
            $order = Order::findOrFail($id);

            // Xóa đơn hàng
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã được xóa thành công.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại.'
            ]);
        }
    }
}