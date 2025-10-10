<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // ambil dari DB sesuai kebutuhan; contoh mock data:
        $days = $request->query('days', 30);

        $productCount = \App\Models\Product::count();
        $incomingCount = \App\Models\Transaction::where('type','in')->where('created_at','>=',now()->subDays($days))->count();
        $outgoingCount = \App\Models\Transaction::where('type','out')->where('created_at','>=',now()->subDays($days))->count();
        $totalStock = \App\Models\Product::sum('stock');

        // contoh data untuk chart
        $labels = [];
        $values = [];
        for ($i = $days-1; $i >= 0; $i--) {
            $labels[] = now()->subDays($i)->format('d M');
            // hitung total stok per hari atau ambil ringkasan
            $values[] = rand(50, 200); // ganti dengan agregasi nyata
        }

        $recentActivities = \App\Models\Activity::latest()->limit(6)->get()->map(function($a){
            return [
                'user' => $a->user->name ?? 'User',
                'action' => $a->description,
                'time' => $a->created_at->diffForHumans(),
                'avatar' => $a->user ? "https://ui-avatars.com/api/?name=" . urlencode($a->user->name) : null
            ];
        })->toArray();

        return view('dashboard', compact(
            'productCount','incomingCount','outgoingCount','totalStock',
            'labels','values','recentActivities'
        ))->with([
            'stockLabels' => $labels,
            'stockValues' => $values
        ]);
    }
}
