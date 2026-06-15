<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display suppliers.
     */
    public function index()
    {
        $suppliers = Supplier::orderBy('sup_kode')
            ->get();

        return view('suppliers.index', compact('suppliers'));
    }


    /**
     * Show the form for creating a new supplier.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in database.
     */
    public function store(Request $request)
    {
        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Show the form for editing a supplier.
     */
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the supplier in database.
     */
    public function update(Request $request, $id)
    {
        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    /**
     * Delete a supplier.
     */
    public function destroy($id)
    {
        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
