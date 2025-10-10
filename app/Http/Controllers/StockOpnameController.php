<?php

namespace App\Http\Controllers;

use App\Services\StockOpnameService;
use Illuminate\Http\Request;

class StockOpnameController extends Controller
{
    protected $opnameService;

    public function __construct(StockOpnameService $opnameService)
    {
        $this->opnameService = $opnameService;
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'actual_stock' => 'required|integer|min:0',
            'note' => 'nullable|string'
        ]);

        $this->opnameService->record($request->product_id, $request->actual_stock, $request->note);
        return response()->json(['message' => 'Stock opname berhasil dicatat']);
    }
}
