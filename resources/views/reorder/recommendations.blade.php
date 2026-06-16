@extends('layouts.app')

@section('page.header')
    <div class="page-header">
        <h4 class="page-title">Reorder Recommendation</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="{{ route('dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Reorder Management</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Recommendations</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title mb-1">
                                Reorder Recommendations
                            </h4>
                            <small class="text-muted d-block">
                                Products that have reached the minimum stock level.
                            </small>
                            <small class="text-danger font-weight-bold d-block">
                                {{ $reorderCount }} Products Require Reorder
                            </small>
                        </div>
                        <form action="{{ route('reorder.drafts.generate') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-alt"></i>
                                REORDER DRAFT
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if ($products->isEmpty())
                        <div class="alert alert-success mb-0">
                            <i class="fas fa-check-circle"></i>
                            All products are above the minimum stock level.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th width="60">No</th>
                                        <th width="150">Product Code</th>
                                        <th style="width:20%">Product Name</th>
                                        <th width="150" class="text-center">Current Stock</th>
                                        <th width="150" class="text-center">Minimum Stock</th>
                                        <th width="150" class="text-center">Suggested Qty</th>
                                        <th width="100" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td class="text-center">
                                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                            </td>
                                            <td>
                                                <strong>{{ $product->prd_kode }}</strong>
                                            </td>
                                            <td>
                                                {{ $product->prd_nama }}
                                            </td>
                                            <td class="text-center">
                                                {{ $product->prd_stok }}
                                            </td>
                                            <td class="text-center">
                                                {{ $product->stok_min }}
                                            </td>
                                            <td class="text-center">
                                                {{ max($product->stok_min - $product->prd_stok, 0) }}
                                            </td>
                                            <td class="text-center">
                                                @if ($product->prd_stok == 0)
                                                    <span class="badge badge-danger">
                                                        Critical
                                                    </span>
                                                @else
                                                    <span class="badge badge-warning">
                                                        Reorder
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted">
                                Showing {{ $products->firstItem() }}
                                to {{ $products->lastItem() }}
                                of {{ $products->total() }} entries
                            </small>
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            window.onload = function() {
                swal({
                    title: "Reorder Draft Created",
                    text: "{{ session('success') }}",
                    icon: "success",
                    button: "OK"
                });
            };
        </script>
    @endif
    @if (session('warning'))
        <script>
            window.onload = function() {
                swal(
                    "Draft Already Exists",
                    "{{ session('warning') }}",
                    "warning"
                );
            };
        </script>
    @endif
@endsection
