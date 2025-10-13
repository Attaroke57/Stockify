<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Activity;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function stock(Request $r)
    {
        $from = $r->query('from');
        $to = $r->query('to');
        $categoryId = $r->query('category');

        $categories = Schema::hasTable('categories') ? Category::orderBy('name')->get() : collect();

        $q = Product::query()->with('category');

        if ($categoryId) $q->where('category_id', $categoryId);

        // if product has stock column
        if (Schema::hasColumn('products', 'stock')) {
            $products = $q->select('id','name','sku','category_id','stock')->orderByDesc('stock')->get();
        } else {
            $products = $q->select('id','name','sku','category_id')->get();
        }

        return view('reports.stock', compact('products','categories','from','to','categoryId'));
    }

    public function exportStock(Request $r)
    {
        $categoryId = $r->query('category');

        $q = Product::query()->with('category');

        if ($categoryId) $q->where('category_id', $categoryId);

        $cols = ['ID','Name','SKU','Category','Stock'];
        $rows = $q->get()->map(function($p){
            return [
                $p->id,
                $p->name,
                $p->sku,
                $p->category->name ?? '',
                $p->stock ?? '',
            ];
        });

        $callback = function() use ($cols, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $cols);
            foreach ($rows as $r) fputcsv($handle, $r);
            fclose($handle);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=stock-report.csv",
        ]);
    }

    public function transactions(Request $r)
    {
        $from = $r->query('from');
        $to = $r->query('to');
        $type = $r->query('type'); // in/out/all

        $q = Schema::hasTable('transactions') ? Transaction::with('product','user')->orderByDesc('created_at') : collect();

        if ($q instanceof \Illuminate\Database\Eloquent\Builder) {
            if ($type && in_array($type, ['in','out'])) $q->where('type', $type);
            if ($from) $q->whereDate('created_at', '>=', $from);
            if ($to) $q->whereDate('created_at', '<=', $to);
            $transactions = $q->get();
        } else {
            $transactions = collect();
        }

        return view('reports.transactions', compact('transactions','from','to','type'));
    }

    public function exportTransactions(Request $r)
    {
        $from = $r->query('from');
        $to = $r->query('to');
        $type = $r->query('type');

        $q = Transaction::with('product','user')->orderByDesc('created_at');
        if ($type && in_array($type, ['in','out'])) $q->where('type', $type);
        if ($from) $q->whereDate('created_at', '>=', $from);
        if ($to) $q->whereDate('created_at', '<=', $to);
        $rows = $q->get()->map(function($t){
            return [
                $t->id,
                $t->product->name ?? '',
                $t->type,
                $t->quantity ?? '',
                $t->user->name ?? '',
                $t->created_at,
                $t->description ?? '',
            ];
        });

        $cols = ['ID','Product','Type','Quantity','User','Date','Description'];

        $callback = function() use ($cols, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $cols);
            foreach ($rows as $r) fputcsv($handle, $r);
            fclose($handle);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=transactions-report.csv",
        ]);
    }

    public function activities(Request $r)
    {
        $from = $r->query('from');
        $to = $r->query('to');
        $userId = $r->query('user');

        $q = Schema::hasTable('activities') ? Activity::with('user')->orderByDesc('created_at') : collect();

        if ($q instanceof \Illuminate\Database\Eloquent\Builder) {
            if ($userId) $q->where('user_id', $userId);
            if ($from) $q->whereDate('created_at', '>=', $from);
            if ($to) $q->whereDate('created_at', '<=', $to);
            $activities = $q->get();
        } else {
            $activities = collect();
        }

        $users = Schema::hasTable('users') ? User::orderBy('name')->get() : collect();

        return view('reports.activities', compact('activities','users','from','to','userId'));
    }

    public function exportActivities(Request $r)
    {
        $from = $r->query('from');
        $to = $r->query('to');
        $userId = $r->query('user');

        $q = Activity::with('user')->orderByDesc('created_at');
        if ($userId) $q->where('user_id', $userId);
        if ($from) $q->whereDate('created_at', '>=', $from);
        if ($to) $q->whereDate('created_at', '<=', $to);

        $rows = $q->get()->map(function($a){
            return [
                $a->id,
                $a->user->name ?? '',
                $a->description ?? '',
                $a->created_at,
            ];
        });

        $cols = ['ID','User','Description','Date'];

        $callback = function() use ($cols, $rows) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $cols);
            foreach ($rows as $r) fputcsv($handle, $r);
            fclose($handle);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=activities-report.csv",
        ]);
    }
}
