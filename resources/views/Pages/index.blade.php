@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}">

@section('page.header')
    <div class="page-header">
        <h4 class="page-title">Dashboard</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Halaman</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Starter Page</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
    <!-- Welcome Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-round welcome-card">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between">
                    <div>
                        <h2 class="fw-bold text-white">
                            Have a great day, Bro and Sis, {{ auth()->user()->name }}!
                        </h2>
                        <p class="text-white mb-0 welcome-text">
                            Tidak semua yang kosong itu menyedihkan. Stok kosong harus segera diisi, hati kosong cukup
                            disyukuri.
                        </p>
                    </div>
                    <div class="welcome-icon">
                        <i class="fa fa-shopping-bag"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Cards -->
<div class="row row-card-no-pd">

    <!-- Supplier -->
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stats card-round dashboard-stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title">Suppliers</h5>
                        <span class="h2 font-weight-bold">
                            {{ $supplierCount }}
                        </span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                            <i class="fa fa-truck"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Product -->
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stats card-round dashboard-stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title">Products</h5>
                        <span class="h2 font-weight-bold">
                            {{ $productCount }}
                        </span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                            <i class="fa fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction -->
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stats card-round dashboard-stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title">Transactions</h5>
                        <span class="h2 font-weight-bold">
                            {{ $transactionCount }}
                        </span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fa fa-history"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reorder Alert -->
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stats card-round dashboard-stat-card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h5 class="card-title">Reorder Alert</h5>
                        <span class="h2 font-weight-bold">
                            {{ $reorderCount }}
                        </span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h4 class="card-title">
            Reorder Recommendations
        </h4>
    </div>
    <div class="card-body">
        @if($reorderProducts->isEmpty())
            <div class="alert alert-success mb-0">
                All products are above minimum stock level.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Current Stock</th>
                            <th>Minimum Stock</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reorderProducts as $product)
                            <tr>
                                <td>{{ $product->prd_kode }}</td>
                                <td>{{ $product->prd_nama }}</td>
                                <td>{{ $product->prd_stok }}</td>
                                <td>{{ $product->stok_min }}</td>
                                <td>
                                    <span class="badge badge-danger">
                                        Reorder Required
                                    </span>
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
