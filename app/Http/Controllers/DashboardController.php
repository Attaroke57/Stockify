<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ambil dari DB sesuai kebutuhan; contoh mock data:
        $days = $request->query('days', 30);

        $productCount = class_exists(\App\Models\Product::class) ? \App\Models\Product::count() : 0;

        if (class_exists(\App\Models\Transaction::class)) {
            $incomingCount = \App\Models\Transaction::where('type','in')->where('created_at','>=',now()->subDays($days))->count();
            $outgoingCount = \App\Models\Transaction::where('type','out')->where('created_at','>=',now()->subDays($days))->count();
        } else {
            $incomingCount = 0;
            $outgoingCount = 0;
        }

        // totalStock: hanya lakukan sum jika kolom ada; coba beberapa nama umum
        $totalStock = 0;
        if (class_exists(\App\Models\Product::class) && Schema::hasTable('products')) {
            foreach (['stock', 'quantity', 'qty'] as $col) {
                if (Schema::hasColumn('products', $col)) {
                    $totalStock = \App\Models\Product::sum($col);
                    break;
                }
            }
        }

        // contoh data untuk chart
        $labels = [];
        $values = [];
        for ($i = $days-1; $i >= 0; $i--) {
            $labels[] = now()->subDays($i)->format('d M');
            // hitung total stok per hari atau ambil ringkasan
            $values[] = rand(50, 200); // ganti dengan agregasi nyata
        }

        $recentActivities = [];
        if (class_exists(\App\Models\Activity::class)) {
            $recentActivities = \App\Models\Activity::latest()->limit(6)->get()->map(function($a){
                return [
                    'user' => $a->user->name ?? 'User',
                    'action' => $a->description,
                    'time' => $a->created_at->diffForHumans(),
                    'avatar' => $a->user ? "https://ui-avatars.com/api/?name=" . urlencode($a->user->name) : null
                ];
            })->toArray();
        }

        return view('components.dashboard', compact(
            'productCount','incomingCount','outgoingCount','totalStock',
            'labels','values','recentActivities'
        ))->with([
            'stockLabels' => $labels,
            'stockValues' => $values
        ]);
    }
}
