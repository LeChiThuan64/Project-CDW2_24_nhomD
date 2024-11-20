<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Product;
class HomeController extends Controller
{
    public function show()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $productModel = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews', 'category'])->orderBy('created_at', 'desc')->take(8)->get();
        $categories = Category::all()->take(3);

        // Lấy dữ liệu chi tiết của sản phẩm
        $products = $productModel->map(function ($product) {
            $productData = $product->getProductDetailData();
            $productData['category'] = $product->category->category_name ?? 'N/A';
            return $productData;
        });
        return view('viewUser.home', compact('products', 'blogs', 'categories'));
    }
}
