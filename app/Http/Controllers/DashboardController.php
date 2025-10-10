<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $statistics = $this->dashboardService->getStatistics();
        $stockChart = $this->dashboardService->getStockChartData();
        $lowStockProducts = $this->dashboardService->getLowStockProducts(5);
        $recentTransactions = $this->dashboardService->getRecentTransactions(8);
        $recentActivities = $this->dashboardService->getRecentActivities(8);
        $topProducts = $this->dashboardService->getTopProductsByValue(5);
        $categoryDistribution = $this->dashboardService->getCategoryDistribution();
        $monthlyTransactionSummary = $this->dashboardService->getMonthlyTransactionSummary();

        return view('dashboard', compact(
            'statistics',
            'stockChart',
            'lowStockProducts',
            'recentTransactions',
            'recentActivities',
            'topProducts',
            'categoryDistribution',
            'monthlyTransactionSummary'
        ));
    }
}
