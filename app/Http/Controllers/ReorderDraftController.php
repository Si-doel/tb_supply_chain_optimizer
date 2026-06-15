<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReorderDraft;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReorderDraftController extends Controller
{
    /**
     * Display reorder drafts.
     */
    public function index(): View
    {
        $drafts = ReorderDraft::with([
            'product',
            'supplier'
        ])
        ->orderBy('rod_id', 'desc')
        ->get();

        return view(
            'reorder.drafts',
            compact('drafts')
        );
    }

    /**
     * Generate reorder drafts from recommendations.
     */
    public function generate(): RedirectResponse
    {
        // Hapus draft lama agar tidak duplicate
        ReorderDraft::truncate();

        $products = Product::whereColumn(
            'prd_stok',
            '<=',
            'stok_min'
        )->get();

        foreach ($products as $product) {

            ReorderDraft::create([
                'prd_id'    => $product->prd_id,
                'sup_id'    => $product->sup_id,
                'rod_qty'   => max(
                    $product->stok_min - $product->prd_stok,
                    0
                ),
                'rod_notes' => 'Auto generated from reorder recommendation'
            ]);
        }

        return redirect()
            ->route('reorder.drafts')
            ->with(
                'success',
                'Reorder draft generated successfully.'
            );
    }
}