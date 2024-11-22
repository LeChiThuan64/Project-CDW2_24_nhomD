<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderReturnResult;
use App\Models\ReturnsOrder;
use Illuminate\Support\Facades\Log;
class OrderReturnResultsController extends Controller
{
    public function getResults($id)
    {
        $results = OrderReturnResult::where('returns_order_id', $id)->get();
        return response()->json($results);
    }
    public function store(Request $request, $id)
    {
        Log::info('Store method called', ['request' => $request->all(), 'id' => $id]);

        $request->validate([
            'product_id' => 'required|integer',
            'return_status' => 'required|string',
            'reason' => 'required|string',
            'orders_id' => 'required|integer',
        ]);

        try {
            OrderReturnResult::create([
                'returns_order_id' => $id,
                'order_id' => $request->orders_id,
                'product_id' => $request->product_id,
                'return_status' => $request->return_status,
                'reason' => $request->reason,
            ]);
            // Cập nhật trạng thái của returns_order thành "Đã xong"
            $returnsOrder = ReturnsOrder::findOrFail($id);
            $returnsOrder->status = 'Đã xong';
            $returnsOrder->save();

            Log::info('OrderReturnResult created successfully', ['returns_order_id' => $id]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error creating OrderReturnResult', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}