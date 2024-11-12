<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('viewAdmin.list_categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        $category = new Category;
        $category->category_name = $request->name;
        $category->description = $request->description;
        $category->save();
        $request->session()->flash('create-success', 'Create category successfully!');
        return redirect()->route('showCategories',);
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
        //
        $category = Category::find($id);

        // Kiểm tra xem danh mục có sản phẩm nào không
        if ($category->products()->count() > 0) {
            // Nếu có, trả về thông báo lỗi
            $request->session()->flash('delete-failure', 'Cannot delete category that has products.');
            return redirect()->back();
        }

        // Nếu không, xóa danh mục
        $category->delete();

        $request->session()->flash('delete-success', 'Category deleted successfully!');
        return redirect()->route('showCategories');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category = Category::find($id);
        $category->category_name = $request->name;
        $category->description = $request->description;
        $category->save();

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
