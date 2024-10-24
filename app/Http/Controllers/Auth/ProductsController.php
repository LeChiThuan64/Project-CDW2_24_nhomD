<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductsController extends Controller
{
    public function showForm()
    {
        // Lấy tất cả danh mục từ bảng categories
        $categories = Category::all();
        return view('viewAdmin.addProducts', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'productName' => 'required|string|max:50', // Sửa max từ 100 thành 50
            'productContent' => 'nullable|string',
            'price' => 'required|integer|min:0', // Kiểu dữ liệu sửa thành integer
            'quantity' => 'required|numeric|min:0', // Kiểu dữ liệu là DECIMAL nên dùng numeric
            'category' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:1024', // Validate ảnh
        ]);

        // Lưu thông tin sản phẩm vào bảng products
        $product = new Product();
        $product->name = $request->productName;
        $product->description = $request->productContent;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category;
        $product->color = $request->selectedColorIds; // Lưu màu đã chọn
        $product->size = implode(',', $request->sizes); // Lưu kích thước đã chọn
        $product->save();

        // Lưu hình ảnh vào bảng product_images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Lưu ảnh vào thư mục storage
                $imagePath = $image->store('product_images', 'public');

                // Lưu đường dẫn ảnh vào bảng product_images
                $productImage = new ProductImage();
                $productImage->product_id = $product->product_id;
                $productImage->image_url = $imagePath;
                $productImage->save();
            }
        }

        // Trả về thông báo thành công
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công!');
    }
}
