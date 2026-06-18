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
        $suppliers = Supplier::orderBy('sup_kode')->get();

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
        $validated = $request->validate([
            'sup_kode'   => 'required|string|max:20|unique:suppliers,sup_kode',
            'sup_nama'   => 'required|string|max:100',
            'sup_telp'   => 'required|string|max:20',
            'sup_email'  => 'nullable|email|max:100',
            'sup_alamat' => 'nullable|string',
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
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
        $supplier = Supplier::findOrFail($id);

        $validated = $request->validate([
            'sup_kode'   => 'required|string|max:20|unique:suppliers,sup_kode,' . $supplier->sup_id . ',sup_id',
            'sup_nama'   => 'required|string|max:100',
            'sup_telp'   => 'required|string|max:20',
            'sup_email'  => 'nullable|email|max:100',
            'sup_alamat' => 'nullable|string',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Delete a supplier.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}
