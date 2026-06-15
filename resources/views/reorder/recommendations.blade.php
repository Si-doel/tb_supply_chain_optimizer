@extends('layouts.app')

@section('page.header')
    <div class="page-header">
        <h4 class="page-title">Reorder Recommendation</h4>

        ```
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
        ```

    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            ```
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <h4 class="card-title mb-1">
                                Reorder Recommendations
                            </h4>

                            <small class="text-muted">
                                Products that have reached the minimum stock level.
                            </small>
                        </div>

                        <div class="d-flex align-items-center">
                            <span class="badge badge-danger me-2">
                                {{ $reorderCount }} Product(s)
                            </span>

                            {{-- <button type="button" class="btn btn-primary btn-sm">
                        <i class="fas fa-file-alt"></i>
                        Generate Draft
                    </button> --}}
                            <form action="{{ route('reorder.drafts.generate') }}" method="POST">

                                @csrf

                                <button type="submit" class="btn btn-primary btn-sm">

                                    <i class="fas fa-file-alt"></i>
                                    Generate Draft

                                </button>

                            </form>
                        </div>

                    </div>
                </div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

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
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Current Stock</th>
                                        <th>Minimum Stock</th>
                                        <th>Suggested Qty</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($products as $product)
                                        <tr>

                                            <td>
                                                {{ ($products->currentPage() - 1) * $products->perPage() + $loop->iteration }}
                                            </td>

                                            <td>
                                                <strong>{{ $product->prd_kode }}</strong>
                                            </td>

                                            <td>{{ $product->prd_nama }}</td>

                                            <td>{{ $product->prd_stok }}</td>

                                            <td>{{ $product->stok_min }}</td>

                                            <td>
                                                {{ max($product->stok_min - $product->prd_stok, 0) }}
                                            </td>

                                            <td>
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

                        {{-- <div class="mt-3 d-flex justify-content-end">
                    {{ $products->links() }}
                </div> --}}
                    @endif

                </div>

            </div>

        </div>
        ```

    </div>
@endsection
