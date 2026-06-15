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

        $reorderProducts = Product::whereColumn(
            'prd_stok',
            '<=',
            'stok_min'
        )->get();

        $reorderCount = $reorderProducts->count();

        return view('Pages.index', compact(
            'supplierCount',
            'productCount',
            'transactionCount',
            'reorderCount',
            'reorderProducts'
        ));
    }
}
