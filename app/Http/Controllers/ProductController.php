<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($product_id)
    {
        $product = Product::find($product_id);

        if (!$product) {
            return abort(404, 'Product not found');
        }

        return view('product.show', compact('product'));
    }

    public function search(Request $request)
    {
        $product_id = $request->query('product_id');
        $product_name = $request->query('name');
    
        if ($product_id || $product_name) {
            $query = Product::query();
    
            if ($product_id) {
                $query->where('product_id', $product_id);
            }
    
            if ($product_name) {
                $query->orWhere('name', 'like', '%' . $product_name . '%');
            }
    
            $product = $query->first();
    
            if ($product) {
                return response()->json(['success' => true, 'product' => $product]);
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No search criteria provided'], 400);
        }
    }
}