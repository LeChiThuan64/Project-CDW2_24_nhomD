<?php
use App\Http\Controllers\ChatboxController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route để hiển thị sản phẩm theo ID
Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('product');
// Route để tìm kiếm sản phẩm
Route::get('/search-product', [ProductController::class, 'search'])->name('product.search');
// Route để lưu dữ liệu người dùng hiệnchatbox
Route::post('/api/save-chatbox-data', [ChatboxController::class, 'saveChatboxData']);
// Route để hiện thị admin supprort chatbox
Route::prefix('admin')->group(function () {
    Route::get('/chatbox', [ChatboxController::class, 'index'])->name('admin.chatbox.index');
    Route::post('/chatbox/update-status/{id}', [ChatboxController::class, 'updateStatus'])->name('admin.chatbox.updateStatus');
    Route::delete('/chatbox/delete/{id}', [ChatboxController::class, 'delete'])->name('admin.chatbox.delete');
});