<?php

namespace App\Http\Controllers;

use App\Services\StockOutService;
use Illuminate\Http\Request;

class StockOutController extends Controller
{
    protected $stockOutService;

    public function __construct(StockOutService $stockOutService)
    {
        $this->stockOutService = $stockOutService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        $result = $this->stockOutService->reduceStock($request->product_id, $request->quantity, $request->note);
        return response()->json($result, $result['status']);
    }
}
