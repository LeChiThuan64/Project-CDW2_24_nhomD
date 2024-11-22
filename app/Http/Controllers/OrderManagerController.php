<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Người dùng hiện tại
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderFail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class OrderManagerController extends Controller
{
    public function show()
    {
        // Lấy danh sách đơn hàng từ cơ sở dữ liệu của người dùng hiện tại
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                $order->daysDifference = Carbon::now()->diffInDays(Carbon::parse($order->created_at));
                return $order;
            });

        // Truyền dữ liệu vào view
        return view('viewUser.orders_manager', compact('orders'));
    }
    // Hàm cập nhật trạng thái đơn hàng
    public function markAsReceived(Request $request, $id)
    {
        // Lấy thông tin đơn hàng từ cơ sở dữ liệu
        $order = Order::findOrFail($id);

        // Cập nhật trạng thái đơn hàng
        $order->update([
            'status' => 'delivered'
        ]);

        return response()->json(['success' => true]);
    }
    public function getErrorDetails($id)
    {
        // Lấy chi tiết lỗi dựa vào order_id
        $errorDetails = OrderFail::where('order_id', $id)->first();

        if ($errorDetails) {
            return response()->json([
                'success' => true,
                'errorDetails' => [
                    'orderId' => $errorDetails->order_id,
                    'errorType' => $errorDetails->error_type,
                    'errorDescription' => $errorDetails->error_description,
                ]
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy chi tiết lỗi cho đơn hàng này.'
            ]);
        }
    }
    public function cancelOrder($id)
    {
        try {
            // Tìm đơn hàng theo ID, ném ngoại lệ nếu không tìm thấy
            $order = Order::findOrFail($id);

            // Thay đổi trạng thái đơn hàng sang "cancelled"
            $order->status = 'cancelled';
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Đơn hàng đã được hủy thành công.'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng.'
            ]);
        }
    }
}