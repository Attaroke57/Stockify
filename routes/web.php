<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Welcome/Landing page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboardcontroller', [DashboardController::class, 'index'])->name('dashboardcontroller');

// Products
Route::resource('products', ProductController::class);
Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
Route::get('products/export', [ProductController::class, 'export'])->name('products.export');

// Suppliers - GUNAKAN RESOURCE (hapus yang lama)
Route::resource('suppliers', SupplierController::class);

// Stock
Route::get('/stock', function () {
    return view('stock.index');
})->name('stock.index');

// Reports
Route::get('/reports', function () {
    return view('reports.index');
})->name('reports.index');

// Users
Route::get('/users', function () {
    return view('users.index');
})->name('users.index');

// Profile
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// Settings
Route::get('/settings', function () {
    return view('settings');
})->name('settings');

// Logout
Route::post('/logout', function () {
    // auth()->logout();
    return redirect('/');
})->name('logout');

// Nanti setelah auth sudah siap, gunakan struktur seperti ini:
/*
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin & Manajer Gudang
    Route::middleware(['role:admin,manajer_gudang'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('stock', StockController::class);
    });

    // Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('suppliers', SupplierController::class);
        Route::resource('users', UserController::class);
    });

    // Reports - Admin & Manajer Gudang
    Route::middleware(['role:admin,manajer_gudang'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', [ProfileController::class, 'settings'])->name('settings');
});
*/
