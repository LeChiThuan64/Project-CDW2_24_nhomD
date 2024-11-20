<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $categories = Category::paginate(5);
    //     return view('viewAdmin.list_categories', compact('categories'));
    // }
    public function index(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ người dùng
        $search = $request->input('search');

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($search) {
            // Tìm kiếm theo ID hoặc tên danh mục
            $categories = Category::selectRaw("
                    categories.*, 
                    MATCH(category_name) AGAINST(? IN BOOLEAN MODE) AS relevance_name, 
                    MATCH(description) AGAINST(? IN BOOLEAN MODE) AS relevance_description
                ", [$search, $search])
                ->whereRaw("MATCH(category_name) AGAINST(? IN BOOLEAN MODE)", [$search])
                ->orWhereRaw("MATCH(description) AGAINST(? IN BOOLEAN MODE)", [$search])
                ->orWhere('category_name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orderByRaw("GREATEST(relevance_name, relevance_description) DESC") // Sắp xếp theo điểm số lớn nhất
                ->paginate(5);

        } else {
            // Nếu không có tìm kiếm, hiển thị danh sách danh mục mặc định
            $categories = Category::paginate(5);
        }

        // Kiểm tra nếu là yêu cầu AJAX
        if ($request->ajax()) {
            return view('viewAdmin.list_categories', compact('categories'))->render();
        }

        // Trả về view chính khi không phải AJAX
        return view('viewAdmin.list_categories', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
{
    // Validate dữ liệu đầu vào
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:500',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Chỉ cho phép file ảnh và kích thước tối đa 2MB
    ]);

    // Tạo category mới
    $category = new Category;
    $category->category_name = $request->name;
    $category->description = $request->description;
    $category->created_at = now();

    // Xử lý hình ảnh nếu có
    if ($request->hasFile('image')) {
        $imageFile = $request->file('image');

        // Đảm bảo tên file không trùng bằng cách thêm timestamp
        $imageName = $imageFile->getClientOriginalName();

        // Lưu ảnh vào thư mục public/assets/img/categories
        $imagePath = 'assets/img/categories/';
        $imageFile->move(public_path($imagePath), $imageName);

        // Lưu đường dẫn ảnh vào database
        $category->image = $imagePath . $imageName;
    }

    // Lưu thông tin category vào cơ sở dữ liệu
    $category->save();

    // Thông báo thành công và chuyển hướng
    $request->session()->flash('create-success', 'Create category successfully!');
    return redirect()->route('showCategories');
}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showCreateForm()
    {
        //
        $categories = Category::all();
        return view('viewAdmin.add_category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Tìm category cần xóa
        $category = Category::find($id);

        // Kiểm tra xem danh mục có tồn tại không
        if (!$category) {
            $request->session()->flash('delete-error', 'Category not found!');
            return redirect()->route('showCategories');
        }

        // Kiểm tra xem danh mục có sản phẩm nào không
        if ($category->products()->count() > 0) {
            // Nếu có sản phẩm, không thể xóa danh mục và trả về thông báo lỗi
            $request->session()->flash('delete-failure', 'Cannot delete category that has products.');
            return redirect()->back();
        }

        // Nếu có hình ảnh, xóa hình ảnh khỏi thư mục
        if ($category->image) {
            $imagePath = public_path('assets/img/categories/' . $category->image);

            // Kiểm tra xem tệp hình ảnh có tồn tại không trước khi xóa
            if (file_exists($imagePath)) {
                unlink($imagePath);  // Xóa tệp hình ảnh
            }
        }

        // Xóa danh mục
        $category->delete();

        // Thông báo thành công và chuyển hướng
        $request->session()->flash('delete-success', 'Category deleted successfully!');
        return redirect()->route('showCategories');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm category cần cập nhật
        $category = Category::find($id);
        if (!$category) {
            // Xử lý trường hợp không tìm thấy category
            $request->session()->flash('update-error', 'Category not found!');
            return redirect()->route('showCategories');
        }

        // Cập nhật thông tin cơ bản
        $category->category_name = $request->name;
        $category->description = $request->description;

        // Kiểm tra và xử lý hình ảnh mới nếu có
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');  // Lấy tệp hình ảnh
            if ($imageFile) {
                $imagePath = public_path('assets/img/categories');

                // Kiểm tra và tạo thư mục nếu chưa tồn tại
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0755, true);
                }

                // Lấy tên tệp ảnh và lưu tệp vào thư mục
                $imageName = $imageFile->getClientOriginalName();
                $imageFile->move($imagePath, $imageName);

                // Cập nhật hình ảnh mới vào cột 'image' của bảng category
                $category->image = $imageName;
            }
        }

        // Lưu thông tin đã cập nhật vào cơ sở dữ liệu
        $category->save();

        // Thông báo thành công và chuyển hướng
        $request->session()->flash('update-success', 'Update category successfully!');
        return redirect()->route('showCategories');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $category = Category::find($id);
        return view('viewAdmin.edit_category', compact('category'));
    }
}
