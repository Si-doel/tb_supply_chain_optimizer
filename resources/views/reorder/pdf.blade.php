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

    </style>
</head>

<body>

    <h2>
        Reorder Draft Report
    </h2>

    <p>
        Supplier :
        {{ $drafts->first()->supplier->sup_nama }}
        <br>
        Supplier Code :
        {{ $drafts->first()->supplier->sup_kode }}
    </p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($drafts as $draft)
            <tr>
                <td>{{ $loop->iteration }}</td>
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
    </table>
</body>

</html>