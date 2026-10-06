<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ProductController;

/*
| 1. PUBLIC PAGES
*/
Route::get('/', function () {
    return auth()->check() ? redirect('/home') : redirect()->route('login');
});

Route::get('/home', function () { return view('index'); });
Route::get('/about', function () { return view('about'); });
Route::get('/contact', function () { return view('contact'); });

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

    // Static admin pages
    Route::get('/admin-dashboard', function () { return view('Admin.dashboard'); });
    Route::get('/admin-orders', function () { return view('Admin.orders'); });
    Route::get('/admin-inventory', function () { return view('Admin.inventory'); });
    Route::get('/admin-customers', function () { return view('Admin.customers'); });

    // Products CRUD -> /admin/products, /admin/products/create, /admin/products/5/edit ...
    Route::prefix('admin')->group(function () {
        Route::resource('products', ProductController::class);

        Route::delete('product-images/{image}', [ProductController::class, 'destroyImage'])
            ->name('product-images.destroy');
    });

    // Purane sidebar links
    Route::get('/admin-products', fn () => redirect()->route('products.index'));
    Route::get('/admin-add-products', fn () => redirect()->route('products.create'))
        ->name('admin-add-products');
});

/*
| 4. USER PAGES
*/
Route::get('/user-dashboard', function () { return view('User.Dashboard'); });
Route::get('/user-order', function () { return view('User.Order'); });
Route::get('/user-wishlist', function () { return view('User.Wishlist'); });