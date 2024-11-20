<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ReviewImage;

class ProductController extends Controller
{
    public function show($product_id)
    {
<<<<<<< HEAD
        $product = Product::find($product_id);

        if (!$product) {
            return abort(404, 'Product not found');
        }

        return view('product.show', compact('product'));
=======
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
    // public function addReview(Request $request, $productId)
    // {
    //     $request->validate([
    //         'rating' => 'required|integer|min:1|max:5',
    //         'comment' => 'required|string|max:255',
    //     ]);

    //     $product = Product::findOrFail($productId);

    //     $existingReview = $product->reviews()->where('user_id', auth()->id())->first();

    //     if ($existingReview) {
    //         // Thông báo nếu đã có đánh giá
    //         return redirect()->back()->with('add-review-error', 'You have already reviewed this product.');
    //     }

    //     $product->reviews()->create([
    //         'user_id' => auth()->id(),
    //         'rating' => $request->input('rating'),
    //         'comment' => $request->input('comment'),
    //     ]);

    //     return redirect()->back()->with('add-review-success', 'Review added successfully!');
    // }

    public function addReview(Request $request, $productId)
    {
        // Xác thực dữ liệu
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);
    
        // Tìm sản phẩm
        $product = Product::findOrFail($productId);
    
        // Kiểm tra nếu user đã đánh giá sản phẩm này
        $existingReview = $product->reviews()->where('user_id', auth()->id())->first();
        if ($existingReview) {
            return redirect()->back()->with('add-review-error', 'You have already reviewed this product.');
        }
    
        // Lưu review vào cơ sở dữ liệu
        $review = $product->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);
    
        // Kiểm tra số lượng ảnh tải lên
        $uploadedFiles = $request->file('images');
        // if ($uploadedFiles && count($uploadedFiles) > 4) {
        //     return redirect()->back()->with('add-review-error', 'You can only upload up to 4 images.');
        // }
    
        // Xử lý hình ảnh nếu có
        if ($uploadedFiles) {
            foreach ($uploadedFiles as $imageFile) {
                if ($imageFile) {
                    // Tạo tên file ảnh duy nhất
                    $imageName = $imageFile->getClientOriginalName();
    
                    // Đường dẫn lưu ảnh
                    $imagePath = 'assets/img/reviews/';
                    $fullImagePath = public_path($imagePath);
                    if (!file_exists($fullImagePath)) {
                        mkdir($fullImagePath, 0755, true);
                    }
    
                    // Lưu file ảnh vào thư mục
                    $imageFile->move($fullImagePath, $imageName);
    
                    // Lưu thông tin ảnh vào bảng review_images
                    ReviewImage::create([
                        'review_id' => $review->id,
                        'image_url' => $imageName, 
                        'created_at' => now(),
                    ]);
                }
            }
        }
    
        // Trả về với thông báo thành công
        return redirect()->back()->with('add-review-success', 'Review added successfully!');
>>>>>>> main
    }
    





    public function search(Request $request)
    {
<<<<<<< HEAD
        $product_id = $request->query('product_id');
        $product_name = $request->query('name');
    
        if ($product_id || $product_name) {
            $query = Product::query();
    
            if ($product_id) {
                $query->where('product_id', $product_id);
            }
    
            if ($product_name) {
                $query->orWhere('name', 'like', '%' . $product_name . '%');
            }
    
            $product = $query->first();
    
            if ($product) {
                return response()->json(['success' => true, 'product' => $product]);
            } else {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'No search criteria provided'], 400);
        }
    }
=======
        try {
            $searchKeyword = $request->query('search-keyword');

            if ($searchKeyword) {
                // Tìm kiếm sản phẩm
                $products = Product::with(['images', 'productSizeColors'])
                    ->selectRaw("
                    products.*, 
                    MATCH(name) AGAINST(? IN BOOLEAN MODE) AS relevance_name, 
                    MATCH(description) AGAINST(? IN BOOLEAN MODE) AS relevance_description
                ", [$searchKeyword, $searchKeyword])
                    ->where(function ($q) use ($searchKeyword) {
                        $q->whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$searchKeyword])
                            ->orWhereRaw("MATCH(description) AGAINST(? IN BOOLEAN MODE)", [$searchKeyword])
                            ->orWhere('name', 'like', '%' . $searchKeyword . '%')
                            ->orWhere('description', 'like', '%' . $searchKeyword . '%');
                    })
                    ->orderByRaw("GREATEST(relevance_name, relevance_description) DESC") // Sắp xếp theo điểm số lớn nhất
                    ->paginate(4);

                // Transform dữ liệu sản phẩm
                $products->getCollection()->transform(function ($product) {
                    // Gán giá và hình ảnh từ quan hệ
                    $product->price = $product->productSizeColors->isNotEmpty()
                        ? $product->productSizeColors->first()->price
                        : null;
                    $product->image = optional($product->images->first())->image_url ?? null;
                    return $product;
                });

                // Trả về view với danh sách sản phẩm
                return view('viewUser.search-results', compact('products'));
            }

            // Nếu không có từ khóa tìm kiếm
            return redirect()->back()->with('error', 'No search criteria provided');

        } catch (\Exception $e) {
            // Xử lý lỗi và thông báo
            return redirect()->back()->with('error', 'Error occurred while searching for product: ' . $e->getMessage());
        }
    }


>>>>>>> main
}