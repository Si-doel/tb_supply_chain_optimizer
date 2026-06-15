<?php

namespace App\Http\Controllers;

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

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created transaction.
     */
    public function store(Request $request)
    {
        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified transaction.
     */
    public function edit($id)
    {
        $transaction = ProductTransaction::findOrFail($id);

        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified transaction.
     */
    public function update(Request $request, $id)
    {
        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified transaction.
     */
    public function destroy($id)
    {
        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}