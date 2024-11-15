<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Product;
class HomeController extends Controller
{
    public function showIntoHome()
    {
        // Lấy blog theo blog_id
        

        // Truyền blog và comments tới view
        return view('viewUser.home', compact('blogs'));
    }

    public function show()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->take(5)->get();
        $productModel = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews', 'category'])->orderBy('created_at', 'desc')->take(8)->get();


        // Lấy dữ liệu chi tiết của sản phẩm
        $products = $productModel->map(function ($product) {
            $productData = $product->getProductDetailData();
            $productData['category'] = $product->category->category_name ?? 'N/A';
            return $productData;
        });
        return view('viewUser.home', compact('products', 'blogs'));
    }
}
