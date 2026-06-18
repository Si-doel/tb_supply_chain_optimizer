<?php

namespace App\Exports;

use App\Models\ReorderDraft;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReorderDraftExport implements
    FromCollection,
    WithHeadings,
    ShouldAutoSize,
    WithStyles
{
    public function collection()
    {
        return ReorderDraft::with([
            'product',
            'supplier'
        ])
        ->orderBy('sup_id')
        ->get()
        ->map(function ($draft) {

            return [
                'supplier_code' => $draft->supplier->sup_kode,
                'supplier_name' => $draft->supplier->sup_nama,
                'product_code'  => $draft->product->prd_kode,
                'product_name'  => $draft->product->prd_nama,
                'quantity'      => $draft->rod_qty,
                'created_at'    => $draft->created_at->format('Y-m-d H:i'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Supplier Code',
            'Supplier Name',
            'Product Code',
            'Product Name',
            'Quantity',
            'Generated Date',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [

            1 => [

                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],

                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'rgb' => 'D9EAD3',
                    ],
                ],

            ],

        ];
    }
}