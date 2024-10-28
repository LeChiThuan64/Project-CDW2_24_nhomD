<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ProductsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminBlogController;
use App\Models\Blog;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/addProducts', function () {
    return view('viewAdmin.addProducts');
});



// Route dashboard
Route::get('/dashboard', function () {
    return view('viewAdmin.dashboard');
});



Route::get('/auth', function () {
    return view('viewUser.auth');
})->name('auth');

Route::get('/logout', function () {
    return view('viewUser.logout');
})->name('logout');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    

// Route trang hiển thị danh sách người dùng (tables.blade.php)
Route::get('/tables', [UserController::class, 'index'])->name('tables');

//blog
Route::get('/blogs', [BlogController::class, 'index']);

// Route xóa người dùng
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Route cho trang thêm người dùng
Route::get('/add-user', [UserController::class, 'create'])->name('user.create');
Route::post('/add-user', [UserController::class, 'store'])->name('user.store');

// Route cho trang chi tiết sản phẩm
Route::get('/product-detail', function () {
    return view('viewUser.product-detail');
});
Route::get('/wishlist', function () {
    return view('viewUser.wishlist');
});
Route::get('/blog_list', function () {
    return view('viewUser.blog_list');
});
// hiển thị blog và chi tiếc blog comment 
Route::get('/blogs_Detal', function () {
    return view('viewUser.blogs_Detal');
});

Route::get('/blogs/{blog_id}', [BlogController::class, 'show'])->name('blog.detail');

Route::post('/blogs/{blog_id}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');

Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
 
Route::get('/admin/blogs/create', function () {
    return view('viewAdmin.add_blog');
})->name('admin.blog.create');


// thêm
Route::post('/admin/blogs', [BlogController::class, 'store'])->name('admin.blog.store');

// tim kiem


// blog ketthuc phia trên


// blog cho admin



Route::get('/blogs_admin', function () {
    $blogs = Blog::orderBy('created_at', 'desc')->paginate(6);
    return view('viewAdmin.blogs_admin', ['blogs' => $blogs]);
});
Route::get('/add_blog', function () {
    return view('viewAdmin.add_blog');
});
// Admin routes
Route::get('/blogs_admin', [BlogController::class, 'adminIndex'])->name('admin.blog.index');
Route::delete('/blogs/{blog_id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

// Route tìm kiếm blogs


// Route::get('/admin/search', 'AdminBlogController@search')->name('admin.search');
// Route::get('/admin/search', [AdminBlogController::class, 'search'])->name('admin.search');

//Het blog cho admin


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Route để hiển thị wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

// Route để thêm sản phẩm vào wishlist
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');

Route::delete('/wishlist/remove/{wishlistId}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// Tìm kiếm
Route::get('/search-results', [ProductController::class, 'search'])->name('product.search');




// Quản lý sản phẩm
// Thêm sản phẩm
Route::get('/products/add', [ProductsController::class, 'showForm'])->name('products.add');
Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');