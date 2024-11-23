<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ReviewImage;
use Crypt;

class ProductController extends Controller
{
    // Hiển thị chi tiết sản phẩm
    public function show($encryptedId)
    {
        try {
            // Giải mã id
            $id = Crypt::decryptString($encryptedId);
        } catch (\Exception $e) {
            // Nếu giải mã thất bại, trả về lỗi 404
            abort(404, 'Invalid Product ID');
        }
        $productsRandomModel = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews'])
            ->inRandomOrder() // Sắp xếp ngẫu nhiên
            ->take(8) // Lấy 8 sản phẩm ngẫu nhiên
            ->get();

        // Chuyển đổi dữ liệu sản phẩm thành mảng và thêm các thông tin cần thiết
        $productsRandom = $productsRandomModel->map(function ($product) {
            $data = $product->getProductDetailData();
            $data['averageRating'] = $product->reviews->avg('rating') ?? 0;
            $data['reviewCount'] = $product->reviews->count();
            return $data;
        });



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
        return view('viewUser.product-detail', compact('product', 'productsRandom'));
    }
    // Thêm phương thức mới để trả về JSON
    public function getProduct($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
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
        if (!auth()->check()) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            return redirect()->route('auth')->with('error', 'You need to login to add a review.');
        }

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
    }






    public function search(Request $request)
{
    try {
        $searchKeyword = $request->query('search-keyword');

        if ($searchKeyword) {
            // Tìm kiếm sản phẩm
            $products = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'reviews', 'category'])
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

            // Chuyển đổi dữ liệu sản phẩm
            $products->getCollection()->transform(function ($product) {
                // Sử dụng phương thức getProductDetailData() để chuẩn hóa dữ liệu
                $data = $product->getProductDetailData();
                $data['averageRating'] = $product->reviews->avg('rating') ?? 0;
                $data['reviewCount'] = $product->reviews->count();
                $data['category'] = $product->category->category_name ?? 'N/A';
                $data['sizesAndColor'] = $product->productSizeColors;
                return $data;
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
    public function searchComparsion(Request $request)
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