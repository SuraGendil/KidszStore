<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Halaman depan
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Rute untuk menampilkan detail produk (oleh pengguna publik)
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Rute untuk cek transaksi
Route::get('/cek-transaksi', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/cek-transaksi/check', [TransactionController::class, 'check'])->name('transaction.check');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Slide
    Route::resource('slides', SlideController::class)->except(['index', 'show']);

    // CRUD Product
    Route::resource('products', ProductController::class)->except(['show']);

    // CRUD Game
    Route::resource('games', GameController::class)->except(['show']);

    // CRUD Category
    Route::resource('categories', CategoriesController::class)->except(['show']);

    // CRUD Order
    // CORRECTED: Add destroy to the allowed methods and ensure the correct controller is used.
    Route::resource('orders', OrderController::class)->except(['show']);

    // CRUD User
    Route::resource('users', UserController::class)->except(['show']);

    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');
});

Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process')->middleware('auth');

// Route untuk menerima notifikasi dari Midtrans (Webhook)
Route::post('/midtrans/notification', [PaymentController::class, 'notificationHandler'])->name('midtrans.notification');

Route::get('/beli-robux', function () {
    return view('robux.index');
})->name('robux.index');

Route::get('/cara-beli', function () {
    return view('how-to-buy.index');
})->name('how-to-buy.index');
require __DIR__ . '/auth.php';
