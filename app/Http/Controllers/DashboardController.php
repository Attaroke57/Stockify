<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Default: range 'minggu'
        $range = $request->get('range', 'minggu');
        $now = Carbon::today();

        // Tentukan periode waktu berdasarkan pilihan
        if ($range === 'minggu') {
            $start = $now->copy()->subDays(6);
            $end = $now;
            $groupFormat = 'Y-m-d';
        } elseif ($range === 'bulan') {
            $start = $now->copy()->startOfMonth();
            $end = $now;
            $groupFormat = 'Y-m-d';
        } elseif ($range === 'tahun') {
            $start = $now->copy()->startOfYear();
            $end = $now;
            $groupFormat = 'Y-m';
        } else {
            $start = $now->copy()->subDays(6);
            $end = $now;
            $groupFormat = 'Y-m-d';
        }

        // Format untuk MySQL
        $dateFormat = $groupFormat === 'Y-m' ? '%Y-%m' : '%Y-%m-%d';

        // Ambil total barang masuk per tanggal
        $stokMasuk = StockTransaction::selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as grup, SUM(quantity) as total")
            ->where('type', 'in')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('grup')
            ->pluck('total', 'grup');

        // Siapkan label dan value untuk chart
        $labels = [];
        $values = [];

        if ($groupFormat === 'Y-m-d') {
            foreach (CarbonPeriod::create($start, $end) as $date) {
                $labels[] = $range === 'bulan'
                    ? $date->translatedFormat('d M')
                    : $date->translatedFormat('l');
                $values[] = $stokMasuk[$date->format('Y-m-d')] ?? 0;
            }
        } else {
            for ($month = $start->month; $month <= $end->month; $month++) {
                $labels[] = Carbon::create()->month($month)->translatedFormat('F');
                $key = $start->copy()->month($month)->format('Y-m');
                $values[] = $stokMasuk[$key] ?? 0;
            }
        }

        // Hitung total data lainnya
        $productCount = Product::count();
        $incomingCount = StockTransaction::where('type', 'in')->count();
        $outgoingCount = StockTransaction::where('type', 'out')->count();
        $totalStock = Product::sum('stock');

        return view('components.dashboard', compact(
            'productCount',
            'incomingCount',
            'outgoingCount',
            'totalStock',
            'labels',
            'values',
            'range'
        ));
    }

    // Endpoint AJAX untuk Chart
    public function getChartData($period = 'minggu')
    {
        $now = Carbon::today();

        if ($period === 'hari') {
            // Data per jam untuk hari ini
            $start = $now->copy()->startOfDay();
            $end = $now->copy()->endOfDay();
            $groupFormat = 'Y-m-d H';
            $dateFormat = '%Y-%m-%d %H';
        } elseif ($period === 'minggu') {
            $start = $now->copy()->subDays(6);
            $end = $now;
            $groupFormat = 'Y-m-d';
            $dateFormat = '%Y-%m-%d';
        } elseif ($period === 'bulan') {
            $start = $now->copy()->startOfMonth();
            $end = $now;
            $groupFormat = 'Y-m-d';
            $dateFormat = '%Y-%m-%d';
        } elseif ($period === 'tahun') {
            $start = $now->copy()->startOfYear();
            $end = $now;
            $groupFormat = 'Y-m';
            $dateFormat = '%Y-%m';
        } else {
            $start = $now->copy()->subDays(6);
            $end = $now;
            $groupFormat = 'Y-m-d';
            $dateFormat = '%Y-%m-%d';
        }

        // Ambil data barang MASUK
        $stokMasuk = StockTransaction::selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as grup, SUM(quantity) as total")
            ->where('type', 'in')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('grup')
            ->pluck('total', 'grup');

        // Ambil data barang KELUAR
        $stokKeluar = StockTransaction::selectRaw("DATE_FORMAT(created_at, '{$dateFormat}') as grup, SUM(quantity) as total")
            ->where('type', 'out')
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('grup')
            ->pluck('total', 'grup');

        $labels = [];
        $incoming = [];
        $outgoing = [];

        if ($period === 'hari') {
            // Per jam untuk hari ini
            for ($hour = 0; $hour < 24; $hour++) {
                $labels[] = sprintf('%02d:00', $hour);
                $key = $start->copy()->hour($hour)->format('Y-m-d H');
                $incoming[] = $stokMasuk[$key] ?? 0;
                $outgoing[] = $stokKeluar[$key] ?? 0;
            }
        } elseif ($groupFormat === 'Y-m-d') {
            foreach (CarbonPeriod::create($start, $end) as $date) {
                if ($period === 'bulan') {
                    $labels[] = $date->translatedFormat('d M');
                } else {
                    $labels[] = $date->translatedFormat('l');
                }
                $key = $date->format('Y-m-d');
                $incoming[] = $stokMasuk[$key] ?? 0;
                $outgoing[] = $stokKeluar[$key] ?? 0;
            }
        } else {
            // Per bulan untuk tahun ini
            for ($month = $start->month; $month <= $end->month; $month++) {
                $labels[] = Carbon::create()->month($month)->translatedFormat('F');
                $key = $start->copy()->month($month)->format('Y-m');
                $incoming[] = $stokMasuk[$key] ?? 0;
                $outgoing[] = $stokKeluar[$key] ?? 0;
            }
        }

        return response()->json([
            'labels' => $labels,
            'incoming' => $incoming,
            'outgoing' => $outgoing,
        ]);
    }
}
