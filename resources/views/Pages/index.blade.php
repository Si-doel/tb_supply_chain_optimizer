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
                <a href="#">Dashboard</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="#">Dashboard Analytics</a>
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

    <div class="row align-items-stretch">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Inventory Overview
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Total Products</span>
                            <strong>{{ $productCount }}</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Safe Products</span>
                            <strong class="text-success">
                                {{ $safeProductCount }}
                            </strong>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Need Reorder</span>
                            <strong class="text-danger">
                                {{ $reorderCount }}
                            </strong>
                        </div>
                        <hr>
                        <div class="text-center">
                            <h2 class="mb-0">
                                {{ $reorderRate }}%
                            </h2>
                            <small class="text-muted">
                                Reorder Rate
                            </small>
                        </div>
                        <div class="progress mt-3">
                            <div class="progress-bar bg-danger" style="width: {{ $reorderRate }}%">
                                {{ $reorderRate }}%
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            @if ($reorderRate >= 50)
                                <span class="badge badge-danger">
                                    Critical
                                </span>
                            @elseif($reorderRate >= 25)
                                <span class="badge badge-warning">
                                    Warning
                                </span>
                            @else
                                <span class="badge badge-success">
                                    Healthy
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="card h-100">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Recent Transactions
                        </h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentTransactions as $transaction)
                                    <tr>
                                        <td>
                                            {{ $transaction->product->prd_nama }}
                                        </td>
                                        <td>
                                            @if ($transaction->trx_type == 'IN')
                                                <span class="badge badge-success">
                                                    IN
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    OUT
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $transaction->trx_qty }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($transaction->trx_date)->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            @if ($reorderProducts->isEmpty())
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
                            @foreach ($reorderProducts as $product)
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
