<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products
     */
    public function index()
    {
        // TODO: Replace with database query when tables ready
        // $products = Product::all();
        
        $products = [
            (object)[
                'product_id' => 1,
                'product_code' => 'PRD001',
                'product_name' => 'Laptop Dell XPS 13',
                'category' => 'Electronics',
                'purchase_price' => 12000000,
                'selling_price' => 15000000,
                'supplier_id' => 1,
                'unit' => 'pcs'
            ],
            (object)[
                'product_id' => 2,
                'product_code' => 'PRD002',
                'product_name' => 'Office Chair Premium',
                'category' => 'Furniture',
                'purchase_price' => 2500000,
                'selling_price' => 3500000,
                'supplier_id' => 2,
                'unit' => 'pcs'
            ]
        ];

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     */
    public function create()
    {
        // TODO: Fetch suppliers for dropdown when table ready
        $suppliers = [];
        return view('products.create', compact('suppliers'));
    }

    /**
     * Store a newly created product in database
     */
    public function store(Request $request)
    {
        // TODO: Implement database save when table ready
        // $product = Product::create($request->validated());
        
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Show the form for editing a product
     */
    public function edit($id)
    {
        // TODO: Fetch product and suppliers when ready
        $product = (object)[
            'product_id' => $id,
            'product_code' => 'PRD001',
            'product_name' => 'Laptop Dell XPS 13',
            'category' => 'Electronics',
            'purchase_price' => 12000000,
            'selling_price' => 15000000,
            'supplier_id' => 1,
            'unit' => 'pcs'
        ];
        $suppliers = [];

        return view('products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the product in database
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement database update when table ready
        // $product = Product::findOrFail($id);
        // $product->update($request->validated());

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Delete a product
     */
    public function destroy($id)
    {
        // TODO: Implement database delete when table ready
        // Product::findOrFail($id)->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
