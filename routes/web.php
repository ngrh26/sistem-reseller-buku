<?php

use Illuminate\Support\Facades\Route;

// ============================================================
// Public & Authentication Controllers
// ============================================================

use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ============================================================
// Admin Controllers
// ============================================================

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ResellerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ReportController;

// ============================================================
// Reseller Controllers
// ============================================================

use App\Http\Controllers\Reseller\DashboardController as ResellerDashboardController;
use App\Http\Controllers\Reseller\CatalogController;
use App\Http\Controllers\Reseller\CartController;
use App\Http\Controllers\Reseller\CheckoutController;
use App\Http\Controllers\Reseller\PaymentController as ResellerPaymentController;
use App\Http\Controllers\Reseller\OrderController as ResellerOrderController;
use App\Http\Controllers\Reseller\ProfileController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])
    ->name('landing');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.process');
});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Semua route di dalam group ini hanya dapat diakses oleh:
| 1. User yang sudah login
| 2. User dengan role admin
|
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // ====================================================
        // Dashboard
        // ====================================================

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        // ====================================================
        // Reseller Management
        // ====================================================

        // Daftar reseller
        Route::get('/resellers', [ResellerController::class, 'index'])
            ->name('resellers.index');

        // Daftar reseller pending
        Route::get('/resellers/pending', [ResellerController::class, 'pending'])
            ->name('resellers.pending');

        // Menyetujui reseller
        Route::post('/resellers/{user}/approve', [ResellerController::class, 'approve'])
            ->name('resellers.approve');

        // Menolak reseller
        Route::post('/resellers/{user}/reject', [ResellerController::class, 'reject'])
            ->name('resellers.reject');

        // Edit reseller
        Route::get('/resellers/{user}/edit', [ResellerController::class, 'edit'])
            ->name('resellers.edit');

        // Update data reseller
        Route::put('/resellers/{user}', [ResellerController::class, 'update'])
            ->name('resellers.update');

        // Reset password reseller
        Route::post('/resellers/{user}/reset-password', [ResellerController::class, 'resetPassword'])
            ->name('resellers.reset-password');

        // Hapus reseller
        Route::delete('/resellers/{user}', [ResellerController::class, 'destroy'])
            ->name('resellers.destroy');


        // ====================================================
        // Product Management
        // ====================================================

        Route::get('/products', [ProductController::class, 'index'])
            ->name('products.index');

        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('products.destroy');


        // ====================================================
        // Order Management
        // ====================================================

        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.update-status');


        // ====================================================
        // Payment Management
        // ====================================================

        Route::get('/payments', [PaymentController::class, 'index'])
            ->name('payments.index');

        Route::get('/payments/{payment}', [PaymentController::class, 'show'])
            ->name('payments.show');

        Route::post('/payments/{payment}/verify', [PaymentController::class, 'verify'])
            ->name('payments.verify');

        Route::post('/payments/{payment}/reject', [PaymentController::class, 'reject'])
            ->name('payments.reject');

        // Download bukti pembayaran
        Route::get('/payments/{payment}/proof', [PaymentController::class, 'downloadProof'])
            ->name('payments.proof');

        // Preview bukti pembayaran secara private
        Route::get('/payments/{payment}/proof/preview', [PaymentController::class, 'previewProof'])
            ->name('payments.proof.preview');


        // ====================================================
        // Reports
        // ====================================================

        // Halaman laporan
        Route::get('/reports', [ReportController::class, 'index'])
            ->name('reports.index');

        // Export laporan ke Excel
        Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])
            ->name('reports.export.excel');

        // Export laporan ke PDF
        Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])
            ->name('reports.export.pdf');
    });


/*
|--------------------------------------------------------------------------
| Reseller Routes
|--------------------------------------------------------------------------
|
| Semua route di dalam group ini hanya dapat diakses oleh:
| 1. User yang sudah login
| 2. User dengan role reseller
| 3. User dengan status active
|
*/

Route::prefix('reseller')
    ->name('reseller.')
    ->middleware(['auth', 'reseller'])
    ->group(function () {

        // ====================================================
        // Dashboard
        // ====================================================

        Route::get('/dashboard', [ResellerDashboardController::class, 'index'])
            ->name('dashboard');


        // ====================================================
        // Profile
        // ====================================================

        Route::get('/profile', [ProfileController::class, 'index'])
            ->name('profile.index');

        Route::put('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password.update');

        Route::delete('/profile/photo', [ProfileController::class, 'removePhoto'])
            ->name('profile.photo.remove');


        // ====================================================
        // Catalog
        // ====================================================

        Route::get('/catalog', [CatalogController::class, 'index'])
            ->name('catalog.index');

        Route::get('/catalog/{product}', [CatalogController::class, 'show'])
            ->name('catalog.show');


        // ====================================================
        // Cart
        // ====================================================

        Route::get('/cart', [CartController::class, 'index'])
            ->name('cart.index');

        Route::post('/cart/{product}', [CartController::class, 'add'])
            ->name('cart.add');

        Route::put('/cart/{product}', [CartController::class, 'update'])
            ->name('cart.update');

        Route::delete('/cart/{product}', [CartController::class, 'remove'])
            ->name('cart.remove');

        Route::delete('/cart', [CartController::class, 'clear'])
            ->name('cart.clear');


        // ====================================================
        // Checkout
        // ====================================================

        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout.index');

        Route::post('/checkout', [CheckoutController::class, 'store'])
            ->name('checkout.store');


        // ====================================================
        // Orders
        // ====================================================

        Route::get('/orders', [ResellerOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/orders/{order}', [ResellerOrderController::class, 'show'])
            ->name('orders.show');

        Route::post('/orders/{order}/cancel', [ResellerOrderController::class, 'cancel'])
            ->name('orders.cancel');


        // ====================================================
        // Payment
        // ====================================================

        Route::get('/orders/{order}/payment', [ResellerPaymentController::class, 'create'])
            ->name('payment.create');

        Route::post('/orders/{order}/payment', [ResellerPaymentController::class, 'store'])
            ->name('payment.store');
    });