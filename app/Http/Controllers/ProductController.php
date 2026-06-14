<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('supplier')
            ->orderBy('prd_kode')
            ->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified product.
     */
    public function destroy(string $id)
    {
        //
    }
}