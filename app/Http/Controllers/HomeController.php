<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Product;
use App\Models\OrderItem;
class HomeController extends Controller
{
    public function show()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $productModel = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews', 'category'])->orderBy('created_at', 'desc')->take(8)->get();
        $categories = Category::all();

        // Lấy dữ liệu chi tiết của sản phẩm mới nhất
        $products = $productModel->map(function ($product) {
            $productData = $product->getProductDetailData();
            $productData['category'] = $product->category->category_name ?? 'N/A';
            $productData['averageRating'] = $product->reviews->avg('rating') ?? 0; // Tính điểm trung bình đánh giá
            $productData['reviewCount'] = $product->reviews->count(); // Số lượng đánh giá
            return $productData;
        });

        //
        $productsByCategory = $categories->mapWithKeys(function ($category) {
            // Lấy 8 sản phẩm cho mỗi danh mục, sắp xếp ngẫu nhiên
            $products = Product::where('category_id', $category->category_id)
                                ->with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews'])
                                ->inRandomOrder() // Sắp xếp ngẫu nhiên
                                ->take(8) // Lấy 8 sản phẩm cho mỗi danh mục
                                ->get();
        
            // Chuyển đổi từng sản phẩm thành mảng và lấy thông tin chi tiết
            $productData = $products->map(function ($product) {
                $data = $product->getProductDetailData();
                $data['averageRating'] = $product->reviews->avg('rating') ?? 0;
                $data['reviewCount'] = $product->reviews->count();
                return $data;
            });
        
            return [$category->category_id => $productData]; // Trả về danh mục và các sản phẩm tương ứng
        });
        

        $topSellingProducts = OrderItem::select('product_id', \DB::raw('SUM(quantity) as total_sold'))
        ->groupBy('product_id')
        ->orderBy('total_sold', 'desc')
        ->take(5) // Lấy 5 sản phẩm bán chạy nhất
        ->with('product.images', 'product.productSizeColors.size', 'product.productSizeColors.color', 'product.reviews', 'product.category')
        ->get()
        ->map(function ($orderItem) {
            $product = $orderItem->product;
            $productData = $product->getProductDetailData();
            $productData['averageRating'] = $product->reviews->avg('rating') ?? '';
            $productData['reviewCount'] = $product->reviews->count();
            return $productData;
        });

        
        return view('viewUser.home', compact('products', 'blogs', 'categories', 'productsByCategory', 'topSellingProducts'));
    }
}
