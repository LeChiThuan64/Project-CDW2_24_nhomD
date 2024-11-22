<?php
// app/Http/Controllers/ReturnsOrderDetailAdminController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnsOrder;
use App\Models\OrderReturnResult;
use Illuminate\Support\Facades\Log;

class ReturnsOrderDetailAdminController extends Controller
{
    public function show($id)
    {
        $returnsOrderDetails = ReturnsOrder::findOrFail($id);
        return view('viewAdmin.returns_order_detail_admin', compact('returnsOrderDetails'));
    }


}