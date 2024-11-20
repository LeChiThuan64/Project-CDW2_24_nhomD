<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

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
        return view('viewAdmin.customer_list', compact('users'));
    }
}