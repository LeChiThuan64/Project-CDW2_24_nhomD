<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ReturnsOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReturnsOrderController extends Controller
{
    // Hiển thị form đổi trả hàng
    public function showReturnOrderForm($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);
        $products = $order->orderItems->map(function ($item) {
            return $item->product;
        });

        // Lấy các tài khoản ngân hàng của người dùng đang đăng nhập
        $user = Auth::user();
        $bankAccounts = $user->bankAccounts; // Giả sử bạn đã thiết lập mối quan hệ

        return view('viewUser.returns_order', compact('order', 'products', 'bankAccounts'));
    }

    // Lưu yêu cầu đổi trả hàng
    public function store(Request $request)
    {
        Log::info('Store method called', ['request' => $request->all()]);

        $request->validate([
            'orders_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,product_id',
            'status' => 'required|string',
            'reason' => 'required|string',
            'details' => 'nullable|string',
            'image1' => 'nullable|image',
            'image2' => 'nullable|image',
            'banking_id' => 'required|exists:bank_accounts,id',
            'phone' => 'required|digits:10',
        ]);

        Log::info('Validated request', ['product_id' => $request->product_id, 'banking_id' => $request->banking_id]);

        try {
            $returnsOrder = new ReturnsOrder();
            $returnsOrder->user_id = Auth::id(); // Lưu ID của người dùng đang đăng nhập
            $returnsOrder->orders_id = $request->orders_id;
            $returnsOrder->product_id = $request->product_id;
            $returnsOrder->status_product = $request->status;
            $returnsOrder->return_reason = $request->reason;
            $returnsOrder->detailed_description = $request->details;
            $returnsOrder->banking_id = $request->banking_id;
            $returnsOrder->phone = $request->phone;
            $returnsOrder->status = 'Chờ xác nhận';


            if ($request->hasFile('image1')) {
                $image1 = $request->file('image1');
                $image1Name = time() . '_1.' . $image1->getClientOriginalExtension();
                $image1->move(public_path('assets/img/returns_order'), $image1Name);
                $returnsOrder->image_1 = $image1Name;
            }

            if ($request->hasFile('image2')) {
                $image2 = $request->file('image2');
                $image2Name = time() . '_2.' . $image2->getClientOriginalExtension();
                $image2->move(public_path('assets/img/returns_order'), $image2Name);
                $returnsOrder->image_2 = $image2Name;
            }

            $returnsOrder->save();

            Log::info('Returns order saved successfully', ['returnsOrder' => $returnsOrder]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error saving returns order', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}