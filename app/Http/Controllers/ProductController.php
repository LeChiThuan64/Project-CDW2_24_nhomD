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
            abort(404, 'Product not found');
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
        // Lấy từ khóa tìm kiếm từ request
        $keyword = $request->input('search-keyword');

        // Tìm kiếm sản phẩm dựa trên từ khóa
        $products = Product::where('name', 'like', '%' . $keyword . '%')
                            ->orWhere('description', 'like', '%' . $keyword . '%')
                            ->get();

        // Trả về view kết quả tìm kiếm
        return view('viewUser.search-results', compact('products', 'keyword'));
    }
}
