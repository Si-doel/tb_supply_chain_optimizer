<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\ProductTransaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $supplierCount = Supplier::count();

        $productCount = Product::count();

        $transactionCount = ProductTransaction::count();

        $reorderCount = Product::whereColumn(
            'prd_stok',
            '<=',
            'stok_min'
        )->count();

        $safeProductCount = Product::whereColumn(
            'prd_stok',
            '>',
            'stok_min'
        )->count();

        $reorderRate = $productCount > 0
            ? round(($reorderCount / $productCount) * 100, 1)
            : 0;

        $recentTransactions = ProductTransaction::with('product')
            ->orderBy('trx_date', 'desc')
            ->orderBy('trx_id', 'desc')
            ->limit(6)
            ->get();

        $reorderProducts = Product::whereColumn(
            'prd_stok',
            '<=',
            'stok_min'
        )
            ->orderBy('updated_at', 'asc')
            ->limit(5)
            ->get();

        return view('Pages.index', compact(
            'supplierCount',
            'productCount',
            'transactionCount',
            'reorderCount',
            'recentTransactions',
            'reorderProducts',
            'safeProductCount',
            'reorderRate'
        ));
    }
}
