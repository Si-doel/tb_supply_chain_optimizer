<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of stock transactions
     */
    public function index()
    {
        // TODO: Replace with database query when tables ready
        // $transactions = StockMovement::with('product')->latest()->paginate(15);
        
        $transactions = [
            (object)[
                'movement_id' => 1,
                'product_code' => 'PRD001',
                'product_name' => 'Laptop Dell XPS 13',
                'qty_change' => 10,
                'movement_type' => 'IN',
                'description' => 'Pembelian dari supplier',
                'transaction_date' => '2026-06-14 10:30:00'
            ],
            (object)[
                'movement_id' => 2,
                'product_code' => 'PRD002',
                'product_name' => 'Office Chair Premium',
                'qty_change' => 5,
                'movement_type' => 'OUT',
                'description' => 'Penjualan ke customer',
                'transaction_date' => '2026-06-14 14:15:00'
            ]
        ];

        return view('Transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction
     */
    public function create()
    {
        // TODO: Fetch products for dropdown when table ready
        $products = [];
        return view('Transactions.create', compact('products'));
    }

    /**
     * Store a newly created transaction in database
     */
    public function store(Request $request)
    {
        // TODO: Implement database save when table ready
        // $transaction = StockMovement::create($request->validated());
        
        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi stok berhasil dicatat');
    }

    /**
     * Show the form for editing a transaction (jika diperlukan)
     */
    public function edit($id)
    {
        // TODO: Fetch transaction and products when ready
        $transaction = (object)[
            'movement_id' => $id,
            'product_code' => 'PRD001',
            'product_name' => 'Laptop Dell XPS 13',
            'qty_change' => 10,
            'movement_type' => 'IN',
            'description' => 'Pembelian dari supplier',
            'transaction_date' => '2026-06-14 10:30:00'
        ];
        $products = [];

        return view('Transactions.edit', compact('transaction', 'products'));
    }

    /**
     * Update the transaction in database
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement database update when table ready
        // $transaction = StockMovement::findOrFail($id);
        // $transaction->update($request->validated());

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Delete a transaction
     */
    public function destroy($id)
    {
        // TODO: Implement database delete when table ready
        // StockMovement::findOrFail($id)->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
