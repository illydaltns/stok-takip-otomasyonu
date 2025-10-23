<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

// 🔓 Misafir (login olmayan kullanıcı) ana sayfası
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('home');
})->middleware('guest');

// 🔐 Auth route'ları (login, register vs.)
require __DIR__ . '/auth.php';

// 🔐 Giriş yapmış kullanıcılar için
Route::middleware(['auth', 'verified'])->group(function () {

    // 🏠 Dashboard yönlendirmesi
    Route::get('/dashboard', function () {
        return redirect()->route('categories.index');
    })->name('dashboard');

    // 👤 Profil Sayfası
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo'); // 📸 Fotoğraf yükleme
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 🗂️ Kategori İşlemleri (CRUD)
    Route::resource('categories', CategoryController::class);

    // 📦 Ürün İşlemleri (CRUD)
    Route::resource('products', ProductController::class);

    // 💸 Satış İşlemleri
    Route::prefix('sales')->group(function () {
        Route::get('/', [SalesController::class, 'index'])->name('sales.index');
        Route::post('/search-product', [SalesController::class, 'searchProduct'])->name('sales.search-product');
        Route::post('/complete', [SalesController::class, 'completeSale'])->name('sales.complete');
   Route::post('/sales/send-simple-receipt', [SalesController::class, 'sendSimpleReceipt'])->name('sales.send-simple-receipt');

    });

    // 👥 Müşteri İşlemleri
    Route::prefix('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
        Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
        Route::post('/{customer}/subscription', [CustomerController::class, 'addSubscription'])->name('customers.addSubscription');
    });

    // İstatistik sayfası
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
    Route::get('/statistics/user/{id}', [StatisticsController::class, 'showUserDetails'])->name('statistics.user.details');
    // 🔍 Kullanıcı detaylı istatistik sayfası (İNCELE)
    Route::get('/statistics/user/{id}', [StatisticsController::class, 'showUserDetails'])->name('statistics.user.details');

    // 🔒 Admin Dashboard Route (Protected by 'auth' middleware)
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // 👥 Kullanıcı İşlemleri (Admin)
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create');
        Route::post('/', [AdminUserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/password-reset-link', [AdminUserController::class, 'sendPasswordResetLink'])->name('sendPasswordResetLink');
    });
});

// 🧪 Geliştirme/Test Sayfası
Route::get('/form-elements', function () {
    return view('form-elements');
});
