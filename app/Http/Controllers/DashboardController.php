<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\ProductTransaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $supplierCount = Supplier::count();
        $productCount = Product::count();
        $transactionCount = ProductTransaction::count();

        return view('Pages.index', compact(
            'supplierCount',
            'productCount',
            'transactionCount'
        ));
    }
}