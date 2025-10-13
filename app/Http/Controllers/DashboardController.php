<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $days = $request->query('days', 30);

        // Hitung jumlah produk
        $productCount = class_exists(\App\Models\Product::class)
            ? \App\Models\Product::count()
            : 0;

        // Hitung barang masuk & keluar
        if (class_exists(\App\Models\Transaction::class)) {
            $incomingCount = \App\Models\Transaction::where('type', 'in')
                ->where('created_at', '>=', now()->subDays($days))
                ->count();

            $outgoingCount = \App\Models\Transaction::where('type', 'out')
                ->where('created_at', '>=', now()->subDays($days))
                ->count();
        } else {
            $incomingCount = 0;
            $outgoingCount = 0;
        }

        // Total stok
        $totalStock = 0;
        if (class_exists(\App\Models\Product::class) && Schema::hasTable('products')) {
            foreach (['stock', 'quantity', 'qty'] as $col) {
                if (Schema::hasColumn('products', $col)) {
                    $totalStock = \App\Models\Product::sum($col);
                    break;
                }
            }
        }

        // --- Data untuk grafik stok ---
        $labels = [];
        $values = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $labels[] = $date->format('d M');

            // Contoh sederhana: total stok rata-rata tiap hari
            if (class_exists(\App\Models\Product::class)) {
                $values[] = \App\Models\Product::sum('stock');
            } else {
                $values[] = rand(50, 200);
            }
        }

        // --- Data aktivitas (hindari error kalau tabel belum ada) ---
        $recentActivities = [];
        if (
            class_exists(\App\Models\Activity::class) &&
            Schema::hasTable('activities')
        ) {
            $recentActivities = \App\Models\Activity::latest()
                ->limit(6)
                ->get()
                ->map(function ($a) {
                    return [
                        'user' => $a->user->name ?? 'User',
                        'action' => $a->description,
                        'time' => $a->created_at->diffForHumans(),
                        'avatar' => $a->user
                            ? "https://ui-avatars.com/api/?name=" . urlencode($a->user->name)
                            : null,
                    ];
                })
                ->toArray();
        }

        return view('components.dashboard', compact(
            'productCount',
            'incomingCount',
            'outgoingCount',
            'totalStock',
            'labels',
            'values',
            'recentActivities'
        ))->with([
            'stockLabels' => $labels,
            'stockValues' => $values,
        ]);
    }

    // --- Endpoint AJAX untuk update grafik ---
public function getChartData(Request $request)
{
    $days = $request->query('days', 30);

    // Contoh data dinamis
    $labels = [];
    $values = [];

    for ($i = $days - 1; $i >= 0; $i--) {
        $labels[] = now()->subDays($i)->format('d M');
        // Misalnya total stok tiap hari (dummy data untuk sementara)
        $values[] = rand(50, 200);
    }

    return response()->json([
        'labels' => $labels,
        'values' => $values,
    ]);
}


}
