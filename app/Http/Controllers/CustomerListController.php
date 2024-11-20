<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerListController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('orders')
            ->withSum('orders', 'total');

        if ($request->get('filter') == 'order_quantity') {
            $query->orderBy('orders_count', 'desc');
        } elseif ($request->get('filter') == 'order_value') {
            $query->orderBy('orders_sum_total', 'desc');
        }

        $users = $query->get();

        // Gọi phương thức để lấy sản phẩm có số lượng mua nhiều nhất cho mỗi user
        $this->attachTopProductToUsers($users);




        return view('viewAdmin.customer_list', compact('users', ));
    }
    public function getUserOrders($id)
    {
        $orders = Order::where('user_id', $id)->with('orderItems')->get();
        return response()->json(['orders' => $orders]);
    }

    private function attachTopProductToUsers($users)
    {
        Log::info('attachTopProductToUsers method called');
        foreach ($users as $user) {
            try {
                $query = $user->orders()
                    ->join('order_items', 'orders.id', '=', 'order_items.order_id')
                    ->join('products', 'order_items.product_id', '=', 'products.product_id')
                    ->select('products.product_id', 'products.name', DB::raw('SUM(order_items.quantity) as total_quantity'))
                    ->groupBy('products.product_id', 'products.name')
                    ->orderBy('total_quantity', 'desc');

                // Log truy vấn SQL
                Log::info("SQL Query for user ID: {$user->id}", ['query' => $query->toSql()]);

                $user->top_product = $query->first();

                // Log kết quả truy vấn
                Log::info("Top product for user ID: {$user->id}", ['top_product' => $user->top_product]);

                // Debug thông tin
                if (!$user->top_product) {
                    Log::info("No top product found for user ID: {$user->id}");
                }
            } catch (\Exception $e) {
                Log::error("Error fetching top product for user ID: {$user->id}", ['error' => $e->getMessage()]);
            }
        }
    }
}