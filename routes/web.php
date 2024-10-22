<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;

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

// Route dashboard
Route::get('/dashboard', function () {
    return view('viewAdmin.dashboard');
});

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

    return view('vieuwAdmin.dashboard');
});

// Route trang hiển thị danh sách người dùng (tables.blade.php)
Route::get('/tables', [UserController::class, 'index'])->name('tables');

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

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Route để hiển thị wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');

// Route để thêm sản phẩm vào wishlist
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');

Route::delete('/wishlist/remove/{wishlistId}', [WishlistController::class, 'remove'])->name('wishlist.remove');

// Tìm kiếm
Route::get('/search-results', [ProductController::class, 'search'])->name('product.search');



