<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSizeColor;
use Illuminate\Support\Facades\Log;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\DB;




class ProductsController extends Controller
{

    private $client;
    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }
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

        // Lấy sản phẩm cùng với quan hệ images, productSizeColors, size, color và category
        $products = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'category']) // Thêm 'category' vào đây
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
                'category_id' => $product->category->category_id ?? 'N/A', // Lấy category_id
                'category_name' => $product->category->category_name ?? 'N/A', // Lấy tên danh mục nếu cần
                'colors' => implode(', ', array_unique($colors)),
                'sizes' => implode(', ', array_unique($sizes)),
                'total_quantity' => $totalQuantity,
                'sizesAndColors' => $product->productSizeColors, // Dữ liệu cho modal
                'images' => $images, // Thêm đường dẫn ảnh
            ];
        });
        $categories = Category::all();

        return view('viewAdmin.list_products', compact('productsData', 'products', 'categories'));
    }



    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('search'); // Lấy từ khóa tìm kiếm từ request
        $categoryId = $request->input('category_id'); // Lấy id danh mục từ request
        $perPage = 10; // Khai báo số sản phẩm trên mỗi trang

        // Khởi tạo biến $productsData và $products
        $productsData = collect();
        $products = null;

        // Kiểm tra xem ô tìm kiếm có trống không
        if (empty($searchTerm)) {
            // Nếu ô tìm kiếm trống, trả về tất cả sản phẩm hoặc một thông báo
            $products = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'category']) // Thêm 'category' vào với
                ->when($categoryId, function ($query) use ($categoryId) {
                    return $query->where('category_id', $categoryId); // Lọc theo danh mục
                })
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);

            // Xử lý dữ liệu sản phẩm
            $productsData = $products->map(function ($product) {
                return [
                    'product_id' => $product->product_id,
                    'name' => $product->name,
                    'description' => $product->description,
                    'category_id' => $product->category->category_id ?? 'N/A', // Lấy category_id
                    'category_name' => $product->category->category_name ?? 'N/A', // Lấy tên danh mục
                    'colors' => implode(', ', $product->productSizeColors->pluck('color.name')->unique()->toArray()),
                    'sizes' => implode(', ', $product->productSizeColors->pluck('size.name')->unique()->toArray()),
                    'total_quantity' => $product->productSizeColors->sum('quantity'),
                    'sizesAndColors' => $product->productSizeColors, // Dữ liệu cho modal
                    'images' => $product->images->map(function ($image) {
                        return asset('assets/img/products/' . $image->file_name);
                    })->toArray(),
                ];
            });
        } else {
            // Tìm kiếm trong Elasticsearch
            $query = [
                'index' => 'products', // Tên index của Elasticsearch
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                [
                                    'multi_match' => [
                                        'query' => $searchTerm,
                                        'fields' => ['product_id', 'name', 'description'] // Các trường để tìm kiếm
                                    ]
                                ]
                            ],
                            // Kiểm tra xem categoryId có được truyền vào không trước khi thêm filter
                            'filter' => $categoryId ? [['term' => ['category_id' => $categoryId]]] : []
                        ]
                    ]
                ]
            ];

            // Tìm kiếm
            $response = $this->client->search($query);

            // Trích xuất dữ liệu từ phản hồi Elasticsearch
            $hits = $response['hits']['hits'];

            // Nếu tìm thấy sản phẩm trong Elasticsearch
            if (count($hits) > 0) {
                $productsData = collect($hits)->map(function ($hit) {
                    $product = $hit['_source'];
                    return [
                        'product_id' => $product['product_id'],
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'category_id' => $product['category_id'] ?? 'N/A', // Lấy category_id an toàn
                        'category_name' => $product['category_name'] ?? 'N/A', // Lấy tên danh mục an toàn
                        'colors' => implode(', ', array_unique(array_column($product['sizesAndColors'], 'color_name'))),
                        'sizes' => implode(', ', array_unique(array_column($product['sizesAndColors'], 'size_name'))),
                        'total_quantity' => array_sum(array_column($product['sizesAndColors'], 'quantity')),
                        'sizesAndColors' => $product['sizesAndColors'], // Dữ liệu cho modal
                        'images' => array_map(function ($image) {
                            return asset('assets/img/products/' . $image);
                        }, $product['images'])
                    ];
                });
            } else {
                // Nếu không tìm thấy, tìm kiếm trong MySQL
                $products = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color', 'category']) // Thêm 'category' vào với
                    ->where(function ($query) use ($searchTerm) {
                        $query->where('product_id', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('name', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('description', 'LIKE', "%{$searchTerm}%");
                    })
                    ->when($categoryId, function ($query) use ($categoryId) {
                        return $query->where('category_id', $categoryId); // Lọc theo danh mục
                    })
                    ->orderBy('updated_at', 'desc')
                    ->paginate($perPage); // Sử dụng biến $perPage đã được khai báo

                // Xử lý dữ liệu sản phẩm
                $productsData = $products->map(function ($product) {
                    return [
                        'product_id' => $product->product_id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'category_id' => $product->category->category_id ?? 'N/A', // Lấy category_id
                        'category_name' => $product->category->category_name ?? 'N/A', // Lấy tên danh mục
                        'colors' => implode(', ', $product->productSizeColors->pluck('color.name')->unique()->toArray()),
                        'sizes' => implode(', ', $product->productSizeColors->pluck('size.name')->unique()->toArray()),
                        'total_quantity' => $product->productSizeColors->sum('quantity'),
                        'sizesAndColors' => $product->productSizeColors, // Dữ liệu cho modal
                        'images' => $product->images->map(function ($image) {
                            return asset('assets/img/products/' . $image->file_name);
                        })->toArray(),
                    ];
                });
            }
        }

        // Nếu không tìm thấy sản phẩm nào thì tạo một paginator rỗng để tránh lỗi
        if ($products === null) {
            $products = new \Illuminate\Pagination\LengthAwarePaginator([], 0, $perPage);
        }

        // Tải danh sách danh mục
        $categories = Category::all();

        return view('viewAdmin.list_products', compact('productsData', 'products', 'categories'));
    }


    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Thực hiện tìm kiếm trong MySQL theo cột 'name'
        $products = Product::with(['images', 'productSizeColors.size', 'productSizeColors.color'])
            ->where('name', 'LIKE', "%{$keyword}%") // Tìm kiếm theo cột 'name'
            ->orderBy('updated_at', 'desc')
            ->paginate(10); // Giới hạn số lượng kết quả trả về

        // Lấy danh sách product_id từ các sản phẩm tìm thấy
        $productIds = $products->pluck('product_id')->toArray();

        // Kiểm tra và tìm kiếm trong Elasticsearch với danh sách product_id
        $response = $this->client->search([
            'index' => 'products',
            'body' => [
                'query' => [
                    'terms' => [
                        'product_id' => $productIds // Tìm kiếm theo danh sách product_id
                    ]
                ]
            ]
        ]);

        // Trích xuất dữ liệu từ Elasticsearch response
        $elasticsearchProducts = collect($response['hits']['hits'])->map(function ($hit) {
            return $hit['_source']; // Trả về dữ liệu gốc của sản phẩm
        });

        // Kết hợp kết quả từ MySQL và Elasticsearch (có thể lọc hoặc bổ sung tùy ý)
        $combinedProducts = $products->map(function ($product) use ($elasticsearchProducts) {
            // Kiểm tra xem sản phẩm có trong Elasticsearch không và gán thêm thông tin từ Elasticsearch nếu có
            $elasticsearchProduct = $elasticsearchProducts->firstWhere('product_id', $product->product_id);
            if ($elasticsearchProduct) {
                // Bạn có thể gán thêm thông tin từ Elasticsearch vào sản phẩm
                // Ví dụ: $product->additional_info = $elasticsearchProduct->additional_info;
            }
            return $product; // Trả về sản phẩm MySQL
        });

        // Trả về danh sách sản phẩm dưới dạng JSON
        return response()->json($combinedProducts);
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
            // Bắt đầu transaction
            DB::beginTransaction();

            // Tìm sản phẩm
            $product = Product::findOrFail($id);

            // Kiểm tra quyền xóa sản phẩm (chỉ cho phép admin hoặc người có quyền)
            $this->authorize('delete', $product);

            // Xóa sản phẩm
            $product->delete();

            // Xóa tất cả hình ảnh có liên kết với sản phẩm
            ProductImage::where('product_id', $id)->delete();

            // Commit transaction nếu mọi thứ thành công
            DB::commit();

            // Ghi log việc xóa sản phẩm
            Log::info('User ' . auth()->id() . ' deleted product ID: ' . $id);

            return response()->json(['success' => 'Sản phẩm và các hình ảnh liên quan đã được xóa thành công.']);
        } catch (\Exception $e) {
            // Rollback transaction nếu có lỗi xảy ra
            DB::rollBack();

            // Ghi log lỗi
            Log::error('Error deleting product ID: ' . $id . ' - ' . $e->getMessage());

            return response()->json(['error' => 'Chỉ amdin có quyền xóa.'], 500);
        }
    }
}
