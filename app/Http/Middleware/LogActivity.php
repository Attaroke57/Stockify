<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class LogActivity
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya log untuk user yang sudah login
        if (auth()->check()) {
            // Skip jika request ke route tertentu
            $skipRoutes = ['logout', 'reports.activities', 'reports.activities.export'];

            if (!in_array($request->route()?->getName(), $skipRoutes)) {
                $this->logActivity($request);
            }
        }

        return $response;
    }

    /**
     * Log aktivitas user
     */
    private function logActivity(Request $request): void
    {
        $description = $this->getActivityDescription($request);

        if ($description) {
            Activity::create([
                'user_id' => auth()->id(),
                'description' => $description,
                'ip' => $request->ip(),
                'meta' => [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'route' => $request->route()?->getName(),
                    'user_agent' => $request->userAgent(),
                ]
            ]);
        }
    }

    /**
     * Dapatkan deskripsi aktivitas berdasarkan route
     */
    private function getActivityDescription(Request $request): ?string
    {
        $routeName = $request->route()?->getName();
        $method = $request->method();

        // Mapping route ke deskripsi aktivitas
        $activityMap = [
            // Auth
            'login' => 'Login ke sistem',
            'register' => 'Registrasi akun baru',
            'logout' => 'Logout dari sistem',

            // Products
            'products.index' => 'Melihat daftar produk',
            'products.create' => 'Membuka form tambah produk',
            'products.store' => 'Menambahkan produk baru',
            'products.show' => 'Melihat detail produk',
            'products.edit' => 'Membuka form edit produk',
            'products.update' => 'Mengubah data produk',
            'products.destroy' => 'Menghapus produk',

            // Stock Transactions
            'stock-transactions.index' => 'Melihat daftar transaksi stok',
            'stock-transactions.create' => 'Membuka form transaksi stok',
            'stock-transactions.store' => 'Mencatat transaksi stok',

            // Reports
            'reports.index' => 'Membuka halaman laporan',
            'reports.stock' => 'Melihat laporan stok',
            'reports.transactions' => 'Melihat laporan transaksi',
            'reports.stock.export' => 'Export laporan stok',
            'reports.transactions.export' => 'Export laporan transaksi',

            // Dashboard
            'dashboard' => 'Mengakses dashboard',
        ];

        return $activityMap[$routeName] ?? null;
    }
}
