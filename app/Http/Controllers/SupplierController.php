<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of suppliers
     */
    public function index()
    {
        // TODO: Replace with database query when tables ready
        // $suppliers = Supplier::all();
        
        $suppliers = [
            (object)[
                'sup_id' => 1,
                'sup_kode' => 'SUP001',
                'sup_nama' => 'PT Sumber Jaya Abadi',
                'sup_telp' => '081234567890',
                'sup_email' => 'contact@sumberjaya.id',
                'sup_alamat' => 'Jl. Merdeka No. 123, Jakarta'
            ],
            (object)[
                'sup_id' => 2,
                'sup_kode' => 'SUP002',
                'sup_nama' => 'CV Maju Makmur',
                'sup_telp' => '081298765432',
                'sup_email' => 'sales@majumakmur.co.id',
                'sup_alamat' => 'Jl. Gatot Subroto No. 456, Bandung'
            ]
        ];

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new supplier
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created supplier in database
     */
    public function store(Request $request)
    {
        // TODO: Implement database save when table ready
        // $supplier = Supplier::create($request->validated());
        
        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Show the form for editing a supplier
     */
    public function edit($id)
    {
        // TODO: Fetch supplier by ID from database when ready
        $supplier = (object)[
            'sup_id' => $id,
            'sup_kode' => 'SUP001',
            'sup_nama' => 'PT Sumber Jaya Abadi',
            'sup_telp' => '081234567890',
            'sup_email' => 'contact@sumberjaya.id',
            'sup_alamat' => 'Jl. Merdeka No. 123, Jakarta'
        ];

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the supplier in database
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement database update when table ready
        // $supplier = Supplier::findOrFail($id);
        // $supplier->update($request->validated());

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    /**
     * Delete a supplier
     */
    public function destroy($id)
    {
        // TODO: Implement database delete when table ready
        // Supplier::findOrFail($id)->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
