<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSizeColor;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function showForm()
    {
        // Lấy tất cả danh mục từ bảng categories
        $categories = Category::all();
        return view('viewAdmin.addProducts', compact('categories'));
    }

    public function showListProducts()
    {
        // Số sản phẩm trên mỗi trang
        $perPage = 10;

        // Lấy sản phẩm cùng với quan hệ images, productSizeColors, size, và color
        $products = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color'])
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        // Xử lý dữ liệu sản phẩm
        $productsData = $products->map(function ($product) {
            $colors = [];
            $sizes = [];
            $totalQuantity = 0;
            $images = $product->images->pluck('image_url')->map(function ($url) {
                return asset('assets/img/products/' . $url);
            })->toArray();


            foreach ($product->productSizeColors as $sizeColor) {
                $colors[] = $sizeColor->color->name ?? 'N/A';
                $sizes[] = $sizeColor->size->name ?? 'N/A';
                $totalQuantity += $sizeColor->quantity;
            }

            // Lấy đường dẫn ảnh từ quan hệ images
            $imageUrls = $product->images->map(function ($image) {
                return $image->image_url;
            });

            return [
                'product_id' => $product->product_id,
                'name' => $product->name,
                'description' => $product->description,
                'colors' => implode(', ', array_unique($colors)),
                'sizes' => implode(', ', array_unique($sizes)),
                'total_quantity' => $totalQuantity,
                'sizesAndColors' => $product->productSizeColors, // Dữ liệu cho modal
                'images' => $images, // Thêm đường dẫn ảnh
            ];
        });

        return view('viewAdmin.list_products', compact('productsData', 'products'));
    }



    public function store(Request $request)
    {

        $data = $request->all();

        // Xác thực dữ liệu
        $request->validate([
            'productName' => 'required|string|max:50',
            'productContent' => 'nullable|string',
            'category' => 'required|integer',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:1024',
            'quantities' => 'required|array',
            'prices' => 'required|array',
            'imageNames' => 'nullable|string' // Xác thực imageNames
        ]);

        // Lưu thông tin sản phẩm vào bảng products
        $product = new Product();
        $product->name = $request->productName;
        $product->description = $request->productContent;
        $product->category_id = $request->category;
        $product->save();

        // ID của sản phẩm vừa lưu
        $productId = $product->product_id;

        // Xử lý từng kết hợp kích thước-màu
        foreach ($request->quantities as $key => $quantity) {
            // $key có định dạng "colorId-sizeId"
            list($colorId, $sizeId) = explode('-', $key);

            // Kiểm tra xem màu và kích thước đã được chọn và nhập giá trị chưa
            if (!isset($request->prices[$key])) {
                continue; // Bỏ qua nếu không có giá trị giá tương ứng
            }

            $price = $request->prices[$key]; // Giá đã nhập

            // Tạo bản ghi mới trong bảng product_size_color
            ProductSizeColor::create([
                'product_id' => $productId,
                'size_id' => $sizeId,
                'color_id' => $colorId,
                'quantity' => $quantity,
                'price' => $price
            ]);
        }



        $imageNames = $request->input('imageNames'); // Lấy giá trị từ trường ẩn
        $imageNamesArray = explode(',', $imageNames); // Chia chuỗi thành mảng


        foreach ($imageNamesArray as $image) {
            // Lưu ảnh vào thư mục storage

            // Lưu đường dẫn ảnh vào bảng product_images
            $productImage = new ProductImage();
            $productImage->product_id = $product->product_id;
            $productImage->image_url = $image;
            $productImage->save();
        }

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm thành công!');
    }



    public function destroy($id)
    {
        try {
            // Tìm và xóa sản phẩm
            $product = Product::findOrFail($id);
            $product->delete();

            // Tìm và xóa tất cả hình ảnh có product_id khớp với id của sản phẩm
            ProductImage::where('product_id', $id)->delete();

            return response()->json(['success' => 'Sản phẩm và các hình ảnh liên quan đã được xóa thành công.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Có lỗi xảy ra.'], 500);
        }
    }
}
