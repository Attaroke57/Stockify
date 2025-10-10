<?php

namespace App\Http\Controllers;

use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function storeMasuk(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $this->stockService->addStock($request->product_id, $request->quantity, $request->notes);

        return response()->json(['message' => 'Barang masuk berhasil dicatat']);
    }

    public function storeKeluar(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        try {
            $this->stockService->reduceStock($request->product_id, $request->quantity, $request->notes);
            return response()->json(['message' => 'Barang keluar berhasil dicatat']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
