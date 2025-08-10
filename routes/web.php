<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Slide;
use Illuminate\Support\Facades\Route;

// Halaman depan
Route::get('/', [SlideController::class, 'publicIndex'])->name('welcome');

// Rute untuk menampilkan detail produk (oleh pengguna publik)
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// Rute untuk cek transaksi
Route::get('/cek-transaksi', [TransactionController::class, 'index'])->name('transaction.index');
Route::get('/cek-transaksi/check', [TransactionController::class, 'check'])->name('transaction.check');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $slides = Slide::all();
        return view('dashboard', ['slides' => $slides]);
    })->name('dashboard');

    // Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [SlideController::class, 'index'])->name('dashboard');

    // CRUD Slide
    Route::resource('slides', SlideController::class)->except(['index', 'show']);

    // CRUD Product pakai ProductController biasa
    Route::resource('products', ProductController::class)->except(['show']);

    // CRUD Order
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'show']);

    // CRUD User
    Route::resource('users', UserController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
