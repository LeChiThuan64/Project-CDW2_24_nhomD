<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderReturnResult;

class OrderReturnResultsController extends Controller
{
    public function getResults($id)
    {
        $results = OrderReturnResult::where('returns_order_id', $id)->get();
        return response()->json($results);
    }
}