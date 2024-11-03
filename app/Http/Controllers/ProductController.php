<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        // Lấy sản phẩm theo ID cùng với các thông tin liên quan
        $product = Product::with([
                'reviews', 
                'category', 
                'images', 
                'productSizeColors.size', 
                'productSizeColors.color'  
            ])
            ->where('product_id', $id)
            ->first(); // Sử dụng first() để lấy một sản phẩm duy nhất
    
        // Kiểm tra nếu sản phẩm không tồn tại
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy sản phẩm'], 404);
        }
    
        // Tính trung bình rating và số lượng đánh giá
        $averageRating = $product->reviews->avg('rating') ?? 0; // Sử dụng $product->reviews thay vì optional()
        $reviewCount = $product->reviews->count(); // Sử dụng $product->reviews
    
        // Lấy danh sách hình ảnh của sản phẩm
        $images = $product->images->pluck('image_url')->toArray(); // Sử dụng `pluck` để lấy mảng các URL ảnh
    
        // Lấy thông tin kích thước và màu sắc cùng với thông tin từ bảng trung gian
        $sizesAndColors = $product->sizesAndColors->map(function ($item) {
            return [
                'size' => optional($item->size)->name, // Lấy tên kích thước
                'color' => optional($item->color)->name, // Lấy tên màu sắc
                'quantity' => $item->pivot->quantity, // Lấy thông tin từ bảng trung gian
                'price' => $item->pivot->price, // Lấy giá từ bảng trung gian
            ];
        });
    
        // Trả về view product-detail và truyền dữ liệu cho view
        return view('viewUser.product-detail', [
            'product' => $product,
            'averageRating' => $averageRating,
            'reviewCount' => $reviewCount,
            'images' => $images,
            'sizesAndColors' => $sizesAndColors,
        ]);
    }
    


    // Thêm đánh giá cho sản phẩm
    public function addReview(Request $request, $productId)
    {
        // Xác thực thông tin đánh giá
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($productId);

        // Thêm đánh giá mới
        $product->reviews()->create([
            'user_id' => auth()->id(), // Lấy ID người dùng hiện tại
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);

        return redirect()->back()->with('success', 'Review added successfully!');
    }

    public function search(Request $request)
    {
        try {
            $product_id = $request->query('product_id');
            $product_name = $request->query('product_name');
        
            if ($product_id || $product_name) {
                $query = Product::with(['images', 'productSizeColors']); // Thêm relationship images              
    
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
                    // Lấy danh sách hình ảnh của sản phẩm
                    $images = $product->images->pluck('image_url')->toArray(); // Sử dụng `pluck` để lấy mảng các URL ảnh

                    // Transform dữ liệu trước khi trả về
                    $productData = [
                        'product_id' => $product->product_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'quantity' => $product->quantity,
                        'images' => $images,
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