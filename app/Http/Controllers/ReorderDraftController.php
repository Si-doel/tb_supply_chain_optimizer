<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReorderDraft;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Exports\ReorderDraftExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

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
            ->orderBy('sup_id')
            ->orderBy('prd_id')
            ->get();

        $draftsBySupplier = $drafts->groupBy('sup_id');

        $totalSuppliers = $drafts
            ->pluck('sup_id')
            ->unique()
            ->count();

        $totalItems = $drafts->count();

        $totalQty = $drafts->sum('rod_qty');

        return view(
            'reorder.drafts',
            compact(
                'drafts',
                'draftsBySupplier',
                'totalSuppliers',
                'totalItems',
                'totalQty'
            )
        );
    }

    /**
     * Generate reorder drafts from recommendations.
     */
    public function generate()
    {
        $todayDraftExists = ReorderDraft::whereDate(
            'created_at',
            today()
        )->exists();

        if ($todayDraftExists) {

            return redirect()
                ->route('reorder.recommendations')
                ->with(
                    'warning',
                    'Reorder draft has already been generated today.'
                );
        }

        ReorderDraft::truncate();

        $products = Product::whereColumn(
            'prd_stok',
            '<=',
            'stok_min'
        )->get();

        $generatedCount = 0;

        foreach ($products as $product) {

            ReorderDraft::create([
                'prd_id' => $product->prd_id,
                'sup_id' => $product->sup_id,
                'rod_qty' => max(
                    $product->stok_min - $product->prd_stok,
                    0
                ),
                'rod_notes' => 'Auto generated'
            ]);

            $generatedCount++;
        }

        return redirect()
            ->route('reorder.recommendations')
            ->with(
                'success',
                $generatedCount . ' reorder draft(s) created successfully.'
            );
    }

    public function exportExcel()
    {
        return Excel::download(
            new ReorderDraftExport(),
            'reorder_draft_' . now()->format('Ymd_His') . '.xlsx'
        );
    }

    public function exportPdf($supplierId)
    {
        $drafts = ReorderDraft::with([
            'product',
            'supplier'
        ])
            ->where('sup_id', $supplierId)
            ->get();

        $pdf = Pdf::loadView(
            'reorder.pdf',
            compact('drafts')
        );

        return $pdf->download(
            'reorder_supplier_' . $supplierId . '.pdf'
        );
    }

    public function exportPdfAll()
    {
        $drafts = ReorderDraft::with([
            'product',
            'supplier'
        ])
            ->orderBy('sup_id')
            ->orderBy('rod_id')
            ->get();

        $draftsBySupplier = $drafts->groupBy('sup_id');

        $pdf = Pdf::loadView(
            'reorder.pdf-all',
            compact('draftsBySupplier')
        );

        return $pdf->download(
            'reorder_draft_all_supplier.pdf'
        );
    }
}
