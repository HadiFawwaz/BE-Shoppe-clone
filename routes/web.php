<?php

use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\BuyerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    // --- JALUR ADMIN ---
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/product', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::post('/admin/status/{id}', [AdminController::class, 'updateStatus'])->name('admin.status.update');
    Route::get('/admin/riwayat', [AdminController::class, 'riwayat'])->name('admin.riwayat');
    Route::get('/admin/product/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::put('/admin/product/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/admin/product/{id}', [AdminController::class, 'destroyProduct'])->name('admin.product.destroy');
    Route::get('/admin/products', [AdminController::class, 'productList'])->name('admin.products');

    // --- JALUR PEMBELI ---
    Route::get('/katalog', [BuyerController::class, 'katalog'])->name('buyer.katalog');
    Route::get('/riwayat', [BuyerController::class, 'riwayat'])->name('buyer.riwayat');
    Route::post('/checkout/{id}', [BuyerController::class, 'checkout'])->name('buyer.checkout');
    // Rute Detail Produk
    Route::get('/product/{id}', [BuyerController::class, 'show'])->name('buyer.product.detail');

    // Rute Profil Pembeli
    Route::get('/buyer/profile', [BuyerController::class, 'profile'])->name('buyer.profile');
    Route::put('/buyer/profile', [BuyerController::class, 'updateProfile'])->name('buyer.profile.update');
    Route::get('/checkout/{id}', [BuyerController::class, 'checkoutPage'])->name('buyer.checkout.page');
});

require __DIR__ . '/auth.php';
