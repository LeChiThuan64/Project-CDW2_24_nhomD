<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReturnsOrder;
use Illuminate\Support\Facades\Log;

class ReturnsOrderManagerController extends Controller
{
    // Hiển thị trang quản lý đơn hàng đổi trả
    public function index()
    {
        // Lấy ID của người dùng hiện tại
        $userId = Auth::id();

        // Lấy danh sách đơn hàng đổi trả từ cơ sở dữ liệu theo ID người dùng
        $returnsOrders = ReturnsOrder::where('user_id', Auth::id())->get();
        // Trả về view với dữ liệu đơn hàng đổi trả
        return view('viewUser.returns_order_manager', compact('returnsOrders'));
    }
    public function updateStatus(Request $request, $id)
    {
        try {
            $returnsOrder = ReturnsOrder::findOrFail($id);
            $returnsOrder->status = $request->status;
            $returnsOrder->save();

            Log::info('ReturnsOrder status updated successfully', ['returns_order_id' => $id]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error updating ReturnsOrder status', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}