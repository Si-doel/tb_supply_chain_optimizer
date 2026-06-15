<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        $transactions = ProductTransaction::with('product')
            ->orderBy('trx_date', 'desc')
            ->get();

        return view('Transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        $products = Product::orderBy('prd_kode')->get();

        return view('Transactions.create', compact('products'));
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'prd_id'    => 'required|exists:products,prd_id',
            'trx_type'  => 'required|in:IN,OUT',
            'trx_qty'   => 'required|integer|min:1',
            'trx_date'  => 'required|date',
            'trx_notes' => 'nullable|string',
        ]);

        // Get the product to update stock
        $product = Product::findOrFail($validated['prd_id']);

        // Check if OUT transaction has enough stock
        if ($validated['trx_type'] === 'OUT' && $product->prd_stok < $validated['trx_qty']) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['trx_qty' => 'Stock tidak mencukupi! Stock saat ini: ' . $product->prd_stok]);
        }

        // Create the transaction
        ProductTransaction::create($validated);

        // Update product stock
        if ($validated['trx_type'] === 'IN') {
            $product->prd_stok += $validated['trx_qty'];
        } else {
            $product->prd_stok -= $validated['trx_qty'];
        }
        $product->save();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $transaction = ProductTransaction::findOrFail($id);
        $products    = Product::orderBy('prd_kode')->get();

        return view('Transactions.edit', compact('transaction', 'products'));
    }

    /**
     * Update the specified transaction.
     */
    public function update(Request $request, $id)
    {
        $transaction = ProductTransaction::findOrFail($id);

        $validated = $request->validate([
            'prd_id'    => 'required|exists:products,prd_id',
            'trx_type'  => 'required|in:IN,OUT',
            'trx_qty'   => 'required|integer|min:1',
            'trx_date'  => 'required|date',
            'trx_notes' => 'nullable|string',
        ]);

        // Revert old stock change
        $oldProduct = Product::find($transaction->prd_id);
        if ($oldProduct) {
            if ($transaction->trx_type === 'IN') {
                $oldProduct->prd_stok -= $transaction->trx_qty;
            } else {
                $oldProduct->prd_stok += $transaction->trx_qty;
            }
            $oldProduct->save();
        }

        // Apply new stock change
        $newProduct = Product::findOrFail($validated['prd_id']);

        if ($validated['trx_type'] === 'OUT' && $newProduct->prd_stok < $validated['trx_qty']) {
            // Rollback the revert if validation fails
            if ($oldProduct) {
                if ($transaction->trx_type === 'IN') {
                    $oldProduct->prd_stok += $transaction->trx_qty;
                } else {
                    $oldProduct->prd_stok -= $transaction->trx_qty;
                }
                $oldProduct->save();
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['trx_qty' => 'Stock tidak mencukupi! Stock saat ini: ' . $newProduct->prd_stok]);
        }

        if ($validated['trx_type'] === 'IN') {
            $newProduct->prd_stok += $validated['trx_qty'];
        } else {
            $newProduct->prd_stok -= $validated['trx_qty'];
        }
        $newProduct->save();

        // Update the transaction record
        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy($id)
    {
        $transaction = ProductTransaction::findOrFail($id);

        // Revert stock change before deleting
        $product = Product::find($transaction->prd_id);
        if ($product) {
            if ($transaction->trx_type === 'IN') {
                $product->prd_stok -= $transaction->trx_qty;
            } else {
                $product->prd_stok += $transaction->trx_qty;
            }
            // Prevent negative stock
            $product->prd_stok = max(0, $product->prd_stok);
            $product->save();
        }

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}