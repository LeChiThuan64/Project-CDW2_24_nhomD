<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Hiển thị chi tiết sản phẩm
    public function show($id)
    {
        $productModel = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews', 'category'])
            ->findOrFail($id);

        $averageRating = $productModel->reviews->avg('rating') ?? 0; // Điểm trung bình rating
        $reviewCount = $productModel->reviews->count(); // Tổng số đánh giá

        $colors = Color::all(); // Lấy tất cả màu sắc từ bảng colors
        $sizes = Size::all(); // Lấy tất cả kích thước từ bảng sizes

        // Lấy dữ liệu chi tiết của sản phẩm
        $product = $productModel->getProductDetailData();
        $product['averageRating'] = $averageRating;
        $product['reviewCount'] = $reviewCount;
        $product['reviews'] = $productModel->reviews;
        $product['category'] = $productModel->category->category_name ?? 'N/A';
        $product['sizesAndColor'] = $productModel->productSizeColors;
        $product['colors'] = $colors;
        $product['sizes'] = $sizes;
        return view('viewUser.product-detail', compact('product'));
    }

    public function getQuantityAndPrice(Request $request)
    {
        $productId = $request->input('product_id');
        $sizeId = $request->input('size_id');
        $colorId = $request->input('color_id');

        // Kiểm tra và lấy số lượng và giá từ bảng trung gian
        $quantityAndPrice = DB::table('product_size_color')
            ->where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->where('color_id', $colorId)
            ->select('quantity', 'price')
            ->first();

        // Nếu không tìm thấy sản phẩm, trả về giá trị mặc định
        if (!$quantityAndPrice) {
            return response()->json(['quantity' => 0, 'price' => 0]);
        }

        // Trả về số lượng và giá đúng định dạng
        return response()->json([
            'quantity' => $quantityAndPrice->quantity,
            'price' => $quantityAndPrice->price
        ]);
    }

    // Thêm đánh giá cho sản phẩm
    public function addReview(Request $request, $productId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:255',
    ]);

    $product = Product::findOrFail($productId);

    $existingReview = $product->reviews()->where('user_id', auth()->id())->first();

    if ($existingReview) {
        // Thông báo nếu đã có đánh giá
        return redirect()->back()->with('add-review-error', 'You have already reviewed this product.');
    }

    $product->reviews()->create([
        'user_id' => auth()->id(),
        'rating' => $request->input('rating'),
        'comment' => $request->input('comment'),
    ]);

    return redirect()->back()->with('add-review-success', 'Review added successfully!');
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