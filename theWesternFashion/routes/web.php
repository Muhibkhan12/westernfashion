<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserDashboardController;   // NEW
use App\Http\Controllers\CustomOrderController;     // NEW

/*
| 1. PUBLIC PAGES
*/
Route::get('/', function () {
    return auth()->check() ? redirect('/home') : redirect()->route('login');
});

Route::get('/home', function () { return view('index'); })->name('home');          // name added
Route::get('/about', function () { return view('about'); })->name('about');        // name added
Route::get('/contact', function () { return view('contact'); })->name('contact');  // name added

// Custom jacket orders (public: guests can send a request too)   // NEW
Route::get('/custom-order', [CustomOrderController::class, 'create'])->name('custom-order.create');
Route::post('/custom-order', [CustomOrderController::class, 'store'])->name('custom-order.store')->middleware('throttle:5,10');

/*
| 2. AUTH (guests only)
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:5,1');

    Route::get('/verify', [AuthController::class, 'showVerify'])->name('verify.show');
    Route::post('/verify', [AuthController::class, 'verify'])->name('verify.check')->middleware('throttle:10,1');
    Route::post('/verify/resend', [AuthController::class, 'resend'])->name('verify.resend')->middleware('throttle:3,1');

    Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
| 3. ADMIN PANEL (login + admin role)
*/
Route::middleware(['auth', 'admin'])->group(function () {

    // Static admin pages (names added)
    Route::get('/admin-dashboard', function () { return view('Admin.dashboard'); })->name('admin.dashboard');
    Route::get('/admin-orders', function () { return view('Admin.orders'); })->name('admin.orders');
    Route::get('/admin-inventory', [InventoryController::class, 'index'])->name('admin.inventory');
    Route::patch('/admin-inventory/{product}/variants', [InventoryController::class, 'updateVariants'])
        ->name('admin.inventory.variants');
    Route::get('/admin-customers', function () { return view('Admin.customers'); })->name('admin.customers');

    // Products CRUD -> /admin/products, /admin/products/create, /admin/products/{id}/edit ...
    Route::prefix('admin')->group(function () {
        Route::resource('products', ProductController::class);

        Route::delete('product-images/{image}', [ProductController::class, 'destroyImage'])
            ->name('product-images.destroy');
    });

    // Old sidebar links
    Route::get('/admin-products', fn () => redirect()->route('products.index'));
    Route::get('/admin-add-products', fn () => redirect()->route('products.create'))
        ->name('admin-add-products');
});

/*
| 4. SHOP (public)
*/
Route::get('/shop', [ShopController::class, 'index'])->name('shop.products');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

/*
| 5. CART (guests allowed, it's session based)
*/
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('throttle:60,1');
Route::patch('/cart/{variant}', [CartController::class, 'update'])->whereUuid('variant')->name('cart.update');
Route::delete('/cart/{variant}', [CartController::class, 'destroy'])->whereUuid('variant')->name('cart.destroy');

/*
| 6. USER AREA (login required)
*/
Route::middleware('auth')->group(function () {

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store')->middleware('throttle:10,1');

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Payment (gateway not connected yet)
    Route::post('/orders/{order}/pay', [PaymentController::class, 'start'])->name('payment.start');

    // User pages
    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');   // NEW: was a closure
    Route::get('/user-order', fn () => redirect()->route('orders.index'));
    Route::get('/user-wishlist', function () { return view('User.Wishlist'); })->name('user.wishlist'); // name added
});