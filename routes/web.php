<?php

use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ProductsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\VocherController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatboxController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CheckoutConfirmation;
use App\Http\Controllers\CategoryController;
use App\Models\Blog;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderManagerController;
use App\Http\Controllers\OrdersDetailsController;
use App\Http\Controllers\OrdersAdminController;
use App\Http\Controllers\CustomerListController;
use App\Http\Controllers\ReturnsOrderController;
use App\Http\Controllers\ReturnsOrderManagerController;
use App\Http\Controllers\ReturnsOrderAdminController;
use App\Http\Controllers\ReturnsOrderDetailAdminController;
use App\Http\Controllers\OrderReturnResultsController;
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






// Route dashboard

// Áp dụng middleware kiểm soát truy cập
Route::middleware(['access.control'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});

// Hiển thị form đăng nhập/ đăng ký
Route::get('/auth', function () {
    return view('viewUser.auth');
})->name('auth');
// Đăng nhập / Đăng ký / Đăng Xuất / Quên Mật Khẩu
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.update');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');


// Route trang hiển thị danh sách người dùng (tables.blade.php)
Route::get('/tables', [UserController::class, 'index'])->name('tables');

//blog
Route::get('/blogs', [BlogController::class, 'index']);

//khóa người dùng
Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus']);


// Route xóa người dùng
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Route cho trang thêm người dùng
Route::get('/add-user', [UserController::class, 'create'])->name('user.create');
Route::post('/add-user', [UserController::class, 'store'])->name('user.store');

// Hiển thị model
Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');

// Route để hiện thị admin supprort chatbox
Route::prefix('admin')->group(function () {
    Route::get('/chatbox', [ChatboxController::class, 'index'])->name('admin.chatbox');
    Route::post('/chatbox/update-status/{id}', [ChatboxController::class, 'updateStatus'])->name('admin.chatbox.updateStatus');
    Route::delete('/chatbox/delete/{id}', [ChatboxController::class, 'delete'])->name('admin.chatbox.delete');
});


// Route cho trang chi tiết sản phẩm
Route::get('/cart', function () {
    return view('viewUser.cart');
});
Route::get('/home', [HomeController::class, 'show'])->name('home.show');

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

// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::post('/cart/apply-voucher', [CartController::class, 'applyVoucher'])->name('cart.applyVoucher');


// Liên hệ CONTACT
Route::get('/contact', function () {
    return view('viewUser.contact');
})->name('contact'); // Đặt tên cho route này nếu cần

// ấu hình này, khi người dùng chưa đăng nhập mà nhấn "Submit", họ sẽ được chuyển hướng đến trang đăng nhập.
// Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('auth');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/contact', function () {
    return view('viewUser.contact'); // Đường dẫn view tới contact.blade.php
})->name('contact');


Route::get('/admin/contact', [ContactController::class, 'index'])->name('contact.index');
// Route phụ để sử dụng URL /contact_admin
Route::get('/contact_admin', [ContactController::class, 'index'])->name('contact.admin');
Route::delete('/admin/contact/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

Route::get('/contact_admin', [ContactController::class, 'index'])->name('contact.admin');

// hết Liên hệ CONTACT

Route::get('/edit_user', function () {
    return view('viewAdmin.edit_user');
});
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');



Route::get('/blogs/{blog_id}', [BlogController::class, 'show'])->name('blog.detail');

Route::post('/blogs/{blog_id}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');

Route::delete('/comments/{comment}', [BlogController::class, 'deleteComment'])->name('comment.delete');

Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');


Route::get('/admin/blogs/create', function () {
    return view('viewAdmin.add_blog');
})->name('admin.blog.create');

// thêm
Route::post('/admin/blogs', [BlogController::class, 'store'])->name('admin.blog.store');


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
Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('upload.image');

// Route cho trang chỉnh sửa blog
Route::get('/admin/blogs/{blog_id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');

// Route để cập nhật blog sau khi chỉnh sửa
Route::post('/admin/blogs/{blog_id}/update', [BlogController::class, 'update'])->name('admin.blog.update');

// Route tìm kiếm blogs


// Route::get('/admin/search', 'AdminBlogController@search')->name('admin.search');
// Route::get('/admin/search', [AdminBlogController::class, 'search'])->name('admin.search');







// Hiển thị trang sản phẩm (locgia.blade.php)
Route::get('/locgia', [ProductsController::class, 'showProducts'])->name('locgia');
// Hiển thị sản phẩm theo danh mục
Route::get('/locgia/category/{id}', [ProductsController::class, 'productsByCategory'])->name('locgia.category');
// Lọc sản phẩm theo khoảng giá (AJAX hoặc query string)
Route::get('/locgia/filter-products', [ProductsController::class, 'filterProducts'])->name('locgia.filter');
// Route hiển thị danh sách sản phẩm chính
Route::get('/products', [ProductsController::class, 'showProducts'])->name('products.index');

//
Route::get('/giamgia', function () {
    return view('viewAdmin.giamgia');
});
Route::get('/vocher_home', function () {
    return view('viewAdmin.vocher_home');
});
Route::get('/vocher', function () {
    return view('viewAdmin.vocher');
});
// Các route liên quan đến Voucher
Route::get('/vocher', [VocherController::class, 'index'])->name('vocher.index');
Route::get('/vocher/create', [VocherController::class, 'create'])->name('vocher.create');
Route::post('/vocher/store', [VocherController::class, 'store'])->name('vocher.store');
Route::get('/vocher/{id}/edit', [VocherController::class, 'edit'])->name('vocher.edit');
Route::put('/vocher/{id}', [VocherController::class, 'update'])->name('vocher.update');
Route::delete('/vocher/{id}', [VocherController::class, 'destroy'])->name('vocher.destroy');
//Het blog cho admin


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
//Route tìm kiếm product
Route::get('/search-product', [ProductController::class, 'searchComparsion']);

// Route để hiển thị wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');


// Route để thêm sản phẩm vào wishlist
Route::post('/wishlist/add/{productId}', [WishlistController::class, 'add'])->name('wishlist.add');

Route::delete('/wishlist/remove/{wishlistId}', [WishlistController::class, 'remove'])->name('wishlist.remove');
// Tim kiem
Route::get('/search-results', [ProductController::class, 'search'])->name('product.search');



// Review
Route::post('/product/{productId}/review', [ProductController::class, 'addReview'])->name('addReview');
Route::post('/reviews/{review_id}/reply', [ReviewController::class, 'store'])->name('reply.store');



// Quản lý sản phẩm
// Thêm sản phẩm
Route::get('/products/add', [ProductsController::class, 'showForm'])->name('products.add');
Route::post('/products/store', [ProductsController::class, 'store'])->name('products.store');
Route::get('/products/showList', [ProductsController::class, 'showListProducts'])->name('products.showListProducts');

// Xóa
// routes/web.php
Route::delete('/products/destroy/{id}', [ProductsController::class, 'destroy'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::get('/products/search', [ProductsController::class, 'searchProducts'])->name('products.search');
Route::get('/products/{id}', [ProductController::class, 'getProduct']);
Route::post('/search', [ProductsController::class, 'search'])->name('products.instant');





// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

// Route để lưu dữ liệu chatbox chatbox
Route::post('/api/save-chatbox-data', [ChatboxController::class, 'saveChatboxData']);

// Route cho Giỏ hàng
Route::prefix('cart')->group(function () {
    // Hiển thị giỏ hàng
    Route::get('/', [CartController::class, 'show'])->name('cart.show');

    // Thêm sản phẩm vào giỏ hàng
    Route::post('/add/{productId}', [CartController::class, 'add'])->name('cart.add');

    // Cập nhật giỏ hàng
    Route::put('/update', [CartController::class, 'update'])->name('cart.update');

    // Xóa sản phẩm khỏi giỏ hàng
    Route::delete('/remove/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');

    // Xóa tất cả sản phẩm khỏi giỏ hàng
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Route cho checkout
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::get('/check-login', function () {
    return response()->json([
        'loggedIn' => auth()->check(),
    ]);
});
// Route lưu thông tin tài khoản ngân hàng
Route::post('/save-bank-account', [BankAccountController::class, 'store'])->middleware('auth')->name('save-bank-account');
// Route lưu thông tin đơn hàng
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Route lấy thông tin sản phẩm trong giỏ hàng
Route::get('/cart-items/{cartItemId}', [OrderItemController::class, 'show']);

// Route hiện thị trang xác nhận checkout
Route::get('/checkout/confirmation', [CheckoutConfirmation::class, 'show']);
// Route xóa tất cả sản phẩm khỏi giỏ hàng
Route::post('/cart/clear', [CartController::class, 'clear']);
// Route để lấy thông tin đơn hàng
Route::get('/checkout/confirmation/{orderId}', [CheckoutConfirmation::class, 'show']);
// Route xóa tất cả sản phẩm khỏi giỏ hàng
Route::get('/admin/categories', [CategoryController::class, 'index'])->name('showCategories');
Route::delete('/admin/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/admin/categories/update/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/admin/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/admin/categories/create', [CategoryController::class, 'create'])->name('category.create');
Route::get('/admin/categories/create', [CategoryController::class, 'showCreateForm'])->name('category.showCreate');

// Router để hiển thị trang quản lý đơn hàng
Route::get('/order-manager', [OrderManagerController::class, 'show'])->name('order.manager.show');
Route::get('/orders/{id}/detail', [OrdersDetailsController::class, 'show'])->name('orders.detail');
Route::post('/orders/{id}/update', [OrdersDetailsController::class, 'update'])->name('order.update');
// Router để hiện thị trang đổi form trả hàng 
Route::get('/returns-order/{id}', [ReturnsOrderController::class, 'showReturnOrderForm'])->name('order.returns');
Route::post('/returns_order', [ReturnsOrderController::class, 'store'])->name('returns_order.store');
//Router hiện thị trang quản lý đơn hàng đổi trả
Route::get('/returns_order_manager', [ReturnsOrderManagerController::class, 'index'])->name('returns_order_manager.index');
//Router update trạng thái đơn hàng
Route::post('/orders/{id}/received', [OrderManagerController::class, 'markAsReceived'])->name('orders.received');

//Router hiện thị trang quản lý đơn hàng admin
Route::get('/admin/orders', [OrdersAdminController::class, 'index'])->name('admin.orders.index');
Route::post('/admin/orders/{id}/confirm', [OrdersAdminController::class, 'confirmOrder'])->name('admin.orders.confirm');
Route::post('/admin/orders/{id}/report-error', [OrdersAdminController::class, 'reportError'])->name('admin.orders.reportError');
Route::delete('/orders/{id}/delete', [OrdersAdminController::class, 'deleteOrder'])->name('orders.delete');
Route::get('/orders/{id}/error-details', [OrderManagerController::class, 'getErrorDetails'])->name('orders.errorDetails');
Route::post('/orders/{id}/resend', [OrdersDetailsController::class, 'resendOrder'])->name('orders.resend');
Route::post('/orders/{id}/cancel', [OrderManagerController::class, 'cancelOrder'])->name('orders.cancel');
Route::get('/api/users/{id}/orders', [CustomerListController::class, 'getUserOrders']);
//Route quản lý đơn hàng đổi trả
Route::get('/admin/returns-orders', [ReturnsOrderAdminController::class, 'index'])->name('returns.orders.index');
Route::get('/returns-orders/{id}', [ReturnsOrderDetailAdminController::class, 'show'])->name('returns.orders.show');
// Route lưu thông tin chi tiết hoàn trả
Route::post('/order-return-results/{id}/store', [OrderReturnResultsController::class, 'store']);
// Route lấy bảng thông báo đổi trả
Route::get('/api/order_return_results/{id}', [OrderReturnResultsController::class, 'getResults']);
// Route cập nhật trạng thái đơn hoàn trả
Route::post('/returns-orders/{id}/update-status', [ReturnsOrderManagerController::class, 'updateStatus']);
// Route xác nhận đổi trả
Route::post('/orders/{id}/product-received', [ReturnsOrderAdminController::class, 'productReceived']);
//Route cho trang danh sách khách hàng admin
Route::get('/customer-list', [CustomerListController::class, 'index'])->name('customer.list');

Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('products.edit');
Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('products.update');

Route::get('/admin/reviews', [ReviewController::class, 'show'])->name('review.show');
Route::delete('/admin/reviews/delete/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
Route::delete('/review/delete/{id}', [ReviewController::class, 'destroyByUser'])->name('review.user.destroy');

Route::get('/about-us', function () {
    return view('viewUser.about_us');
})->name('about-us.show');




Route::post('/ckeditor/upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('ckeditor.upload');
