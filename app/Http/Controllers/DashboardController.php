<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use DB;
class DashboardController extends Controller
{
    public function index()
    {
        // Tính tổng total của tất cả các đơn hàng
        $totalRevenue = Order::sum('total');
        // Tính tổng total của tất cả các đơn hàng trong ngày hiện tại
        $today = Carbon::today();
        $totalRevenueToday = Order::whereDate('created_at', $today)->sum('total');

        // Tính tổng total của tất cả các đơn hàng trong tháng hiện tại
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        $totalRevenueThisMonth = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->sum('total');

        // Tính tổng số lượng users
        $totalUsers = User::count();

        // Tính tổng số lượng sản phẩm
        $totalProducts = Product::count();

        // Tính tổng số lượng đơn hàng
        $totalOrders = Order::count();

        // Lấy user có giá trị đơn hàng nhiều nhất
        $topUser = Order::select('user_id', DB::raw('COUNT(*) as order_count'), DB::raw('SUM(total) as total_value'))
            ->groupBy('user_id')
            ->orderBy('total_value', 'desc')
            ->first();

        $topUserName = User::find($topUser->user_id)->name;
        $topUserOrderCount = $topUser->order_count;
        $topUserTotalValue = $topUser->total_value;

        // Truyền dữ liệu vào view
        return view('viewAdmin.dashboard', compact('totalRevenue', 'totalRevenueToday', 'totalRevenueThisMonth', 'totalUsers', 'totalProducts', 'topUserName', 'topUserOrderCount', 'topUserTotalValue', 'totalOrders'));
    }
}