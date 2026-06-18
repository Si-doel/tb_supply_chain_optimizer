<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReorderRecommendationController extends Controller
{
    public function index()
    {
        $products = Product::whereColumn(
                'prd_stok',
                '<=',
                'stok_min'
            )
            ->orderBy('prd_stok', 'asc')
            ->paginate(10);

        $reorderCount = $products->total();

        return view(
            'reorder.recommendations',
            compact(
                'products',
                'reorderCount'
            )
        );
    }
}