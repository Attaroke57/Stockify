<?php
use App\Http\Controllers\AuthController;
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

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {

    // Dashboard - Semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Di routes/web.php
    Route::get('/dashboard/data/{period}', [DashboardController::class, 'getChartData'])->name('dashboard.data');

    // Stock - Semua role bisa akses (admin, manager, staff)
    Route::resource('stocks', StockController::class);

    // Products - Admin & Manager only
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::post('products/import', [ProductController::class, 'import'])->name('products.import');
        Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
    });

    // Suppliers - Admin & Manager only
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::resource('suppliers', SupplierController::class);
    });

    // Reports - Admin & Manager only
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/stock', [ReportController::class, 'stock'])->name('reports.stock');
        Route::get('reports/stock/export', [ReportController::class, 'exportStock'])->name('reports.stock.export');
        Route::get('reports/transactions', [ReportController::class, 'transactions'])->name('reports.transactions');
        Route::get('reports/transactions/export', [ReportController::class, 'exportTransactions'])->name('reports.transactions.export');
        Route::get('reports/activities', [ReportController::class, 'activities'])->name('reports.activities');
        Route::get('reports/activities/export', [ReportController::class, 'exportActivities'])->name('reports.activities.export');
    });

    // Users - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Profile & Settings - Semua role
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});
