<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($product_id)
    {
        try {
            // Lấy sản phẩm cùng với các hình ảnh liên quan
            $product = Product::with('images')->findOrFail($product_id);
            // Kiểm tra đường dẫn image_url
            foreach ($product->images as $image) {
                console.log($image->image_url); // In ra từng đường dẫn hình ảnh
            }            
            return view('product.show', compact('product'));
        } catch (\Exception $e) {
            return abort(404, 'Product not found');
        }
    }

    public function search(Request $request)
    {
        try {
            $product_id = $request->query('product_id');
            $product_name = $request->query('product_name');
        
            if ($product_id || $product_name) {
                $query = Product::with('images'); // Thêm relationship images
    
                // Nhóm điều kiện tìm kiếm với hàm nặc danh (closure)
                $query->where(function ($q) use ($product_id, $product_name) {
                    if ($product_id) {
                        $q->where('product_id', $product_id);
                    }
    
                    if ($product_name) {
                        $q->orWhere('name', 'like', '%' . $product_name . '%');
                    }
                });
    
                $product = $query->first();
        
                if ($product) {
                    // Transform dữ liệu trước khi trả về
                    $productData = [
                        'product_id' => $product->product_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'quantity' => $product->quantity,
                        'images' => $product->images->map(function($image) {
                            return [
                                'image_id' => $image->image_id,
                                'image_url' => $image->image_url
                            ];
                        })
                    ];
        
                    return response()->json([
                        'success' => true, 
                        'product' => $productData
                    ]);
                }
        
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found'
                ], 404);
            }
        
            return response()->json([
                'success' => false,
                'message' => 'No search criteria provided'
            ], 400);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error occurred while searching for product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
}