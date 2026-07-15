<?php

use App\Http\Controllers\Admin\FlowerController as AdminFlowerController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\WrapperController as AdminWrapperController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PlannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/planner', [PlannerController::class, 'index'])->name('planner');
Route::get('/catalog', [PlannerController::class, 'catalog'])->name('catalog');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth')->name('orders.store');

Route::get('/bouquets', [PageController::class, 'bouquets'])->name('bouquets');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/news', [PageController::class, 'news'])->name('news');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.attempt');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Riwayat pesanan customer
Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [MyOrderController::class, 'index'])->name('my-orders');
});

// Area admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/flowers')->name('dashboard');

    Route::resource('flowers', AdminFlowerController::class)->except(['show']);
    Route::resource('wrappers', AdminWrapperController::class)->except(['show']);

    Route::get('orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});
Route::get('/jalankan-migrasi-koneksi', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
            '--force' => true,
            '--seed' => true
        ]);
        return 'Selamat! Database berhasil dimigrasi dan di-seed total dari nol!';
    } catch (\Exception $e) {
        return 'Gagal: ' . $e->getMessage();
    }
});