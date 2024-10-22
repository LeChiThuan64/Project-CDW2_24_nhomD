<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        // Lấy sản phẩm theo ID cùng với đánh giá, danh mục và hình ảnh
        $product = Product::with(['reviews', 'category', 'images'])->find($id);

        // Tính trung bình rating và số lượng đánh giá
        $averageRating = $product->reviews->avg('rating') ?? 0; // Đảm bảo không bị lỗi khi không có đánh giá
        $reviewCount = $product->reviews->count();

        // Lấy danh sách hình ảnh của sản phẩm
        $images = $product->images->pluck('image_url')->toArray(); // Sử dụng `pluck` để lấy mảng các URL ảnh

        // Trả về view product-detail và truyền dữ liệu cho view
        return view('viewUser.product-detail', [
            'product' => $product,
            'averageRating' => $averageRating,
            'reviewCount' => $reviewCount,
            'images' => $images,
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
