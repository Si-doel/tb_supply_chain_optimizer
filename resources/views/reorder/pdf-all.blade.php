<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
        }

        th {
            background: #f2f2f2;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    @foreach ($draftsBySupplier as $supplierDrafts)
        <h2 style="text-align:center;">
            REORDER RECOMMENDATION REPORT
        </h2>
        <p style="text-align:center;">
            Generated :
            {{ now()->format('d M Y H:i') }}
        </p>
        <table style="border:none; margin-bottom:15px;">
            <tr>
                <td style="border:none; width:150px;">
                    Supplier Name
                </td>
                <td style="border:none;">
                    :
                    {{ $supplierDrafts->first()->supplier->sup_nama }}
                </td>
            </tr>
            <tr>
                <td style="border:none;">
                    Supplier Code
                </td>
                <td style="border:none;">
                    :
                    {{ $supplierDrafts->first()->supplier->sup_kode }}
                </td>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th width="40">No</th>
                    <th width="120">Product Code</th>
                    <th>Product Name</th>
                    <th width="100">Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplierDrafts as $draft)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $draft->product->prd_kode }}
                        </td>
                        <td>
                            {{ $draft->product->prd_nama }}
                        </td>
                        <td>
                            {{ $draft->rod_qty }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align:right;">
                        Total Quantity
                    </th>
                    <th>
                        {{ $supplierDrafts->sum('rod_qty') }}
                    </th>
                </tr>
            </tfoot>
        </table>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

</body>

</html>
