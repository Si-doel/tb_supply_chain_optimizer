@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Products</h4>

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
            <a href="#">Master Data</a>
        </li>

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">Products</a>
        </li>
    </ul>
</div>
@endsection

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h4 class="card-title mb-0">
            Product List
        </h4>

        <a href="{{ route('products.create') }}"
           class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>
            Add Product

        </a>

    </div>

    <div class="card-body">

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($products->isEmpty())

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                No product data available.
            </div>

        @else

            <div class="table-responsive">

                <table class="table table-striped table-hover">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Supplier</th>
                            <th>Current Stock</th>
                            <th>Minimum Stock</th>
                            <th>Status</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($products as $product)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $product->prd_kode }}
                                </strong>
                            </td>

                            <td>
                                {{ $product->prd_nama }}
                            </td>

                            <td>
                                {{ $product->supplier->sup_nama ?? '-' }}
                            </td>

                            <td>
                                {{ $product->prd_stok }}
                            </td>

                            <td>
                                {{ $product->stok_min }}
                            </td>

                            <td>

                                @if($product->prd_stok <= $product->stok_min)

                                    <span class="badge badge-danger">
                                        Reorder Needed
                                    </span>

                                @else

                                    <span class="badge badge-success">
                                        In Stock
                                    </span>

                                @endif

                            </td>

                            <td>

                                <a href="{{ route('products.edit', $product->prd_id) }}"
                                   class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <form action="{{ route('products.destroy', $product->prd_id) }}"
                                      method="POST"
                                      style="display:inline-block;">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this product?')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>

@endsection