    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\ChatboxController;

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
    // Route để tìm kiếm sn phẩn
    Route::get('/search-product', [ProductController::class, 'search']);

    Route::prefix('admin')->group(function () {
        Route::get('/chatbox', [ChatboxController::class, 'index'])->name('admin.chatbox.index');
        Route::post('/chatbox/update-status/{id}', [ChatboxController::class, 'updateStatus'])->name('admin.chatbox.updateStatus');
    });