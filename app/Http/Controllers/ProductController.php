<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
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
        $suppliers = Supplier::orderBy('sup_nama')->get();

        return view('products.create', compact('suppliers'));
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prd_kode' => 'required|string|max:20|unique:products,prd_kode',
            'prd_nama' => 'required|string|max:100',
            'sup_id'   => 'required|exists:suppliers,sup_id',
            'prd_stok' => 'required|integer|min:0',
            'stok_min' => 'required|integer|min:0',
            'hpp'      => 'required|numeric|min:0',
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        $product   = Product::findOrFail($id);
        $suppliers = Supplier::orderBy('sup_nama')->get();

        return view('products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'prd_kode' => 'required|string|max:20|unique:products,prd_kode,' . $product->prd_id . ',prd_id',
            'prd_nama' => 'required|string|max:100',
            'sup_id'   => 'required|exists:suppliers,sup_id',
            'prd_stok' => 'required|integer|min:0',
            'stok_min' => 'required|integer|min:0',
            'hpp'      => 'required|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil diperbarui.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product berhasil dihapus.');
    }
}