<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route trang chủ
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

// Route trang hiển thị danh sách người dùng (tables.blade.php)
Route::get('/tables', [UserController::class, 'index'])->name('tables');

// Route xóa người dùng
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Route cho trang thêm người dùng
Route::get('/add-user', [UserController::class, 'create'])->name('user.create');
Route::post('/add-user', [UserController::class, 'store'])->name('user.store');

// Route cho trang chi tiết sản phẩm
Route::get('/product-detail', function () {
    return view('viewUser.navigation');
});
