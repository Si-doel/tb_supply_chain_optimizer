@extends('layouts.app')

@section('page.header')
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h4 class="card-title mb-1">
                    Reorder Draft Summary
                </h4>
                <small class="text-muted">
                    Generated :
                    {{ optional($drafts->first())->created_at?->format('d M Y H:i') }}
                </small>
            </div>
            <div>
                <a href="{{ route('reorder.drafts.export.excel') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel"></i>
                    Export Excel
                </a>
                <a href="{{ route('reorder.drafts.export.pdf.all') }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i>
                    Export PDF
                </a>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <h3 class="mb-1">{{ $totalSuppliers }}</h3>
                    <small class="text-muted">
                        Suppliers
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <h3 class="mb-1">{{ $totalItems }}</h3>
                    <small class="text-muted">
                        Draft Items
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-round">
                <div class="card-body text-center">
                    <h3 class="mb-1">{{ $totalQty }}</h3>
                    <small class="text-muted">
                        Total Quantity
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Reorder Draft List
            </h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if ($drafts->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    No reorder draft available.
                </div>
            @else
                @foreach ($draftsBySupplier as $supplierId => $supplierDrafts)
                    <div class="card mb-4 shadow-sm" style="border-left:4px solid #1572E8;">
                        <div class="card-header bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1 fw-bold text-primary">
                                        {{ $supplierDrafts->first()->supplier->sup_nama }}
                                    </h5>
                                    <small class="text-muted d-block">
                                        Supplier Code :
                                        {{ $supplierDrafts->first()->supplier->sup_kode }}
                                    </small>
                                    <small class="text-muted">
                                        {{ $supplierDrafts->count() }} products ready for reorder
                                    </small>
                                </div>
                                <div class="text-end">
                                    <a href="{{ route('reorder.drafts.export.pdf', $supplierId) }}"
                                        class="btn btn-danger btn-sm px-3 py-2 mr-1">
                                        <i class="fas fa-file-pdf"></i>
                                        Print to PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="60" class="text-center">
                                                No
                                            </th>
                                            <th width="150">
                                                Product Code
                                            </th>
                                            <th>
                                                Product Name
                                            </th>
                                            <th width="150" class="text-center">
                                                Quantity
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplierDrafts as $draft)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    <strong>
                                                        {{ $draft->product->prd_kode }}
                                                    </strong>
                                                </td>
                                                <td>
                                                    {{ $draft->product->prd_nama }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $draft->rod_qty }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">
                                                Total Quantity
                                            </th>
                                            <th class="text-center">
                                                {{ $supplierDrafts->sum('rod_qty') }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
