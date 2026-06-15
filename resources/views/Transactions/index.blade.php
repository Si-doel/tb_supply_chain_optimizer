@extends('layouts.app')

@section('page.header')
    <div class="page-header">
        <h4 class="page-title">Product Transactions</h4>

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
                <a href="#">Transactions</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="card-title">
                Transaction List
            </h4>

            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">

                <i class="fas fa-plus"></i>
                Add Transaction

            </a>

        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($transactions->isEmpty())
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    No transaction data available.
                </div>
            @else
                <div class="table-responsive">

                    <table class="table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Quantity</th>
                                <th>Notes</th>
                                <th style="width:100px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($transactions as $transaction)
                                <tr>

                                    <td>
                                        {{ $loop->iteration }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($transaction->trx_date)->format('d M Y') }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $transaction->product->prd_kode ?? '-' }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $transaction->product->prd_nama ?? '-' }}
                                    </td>

                                    <td>

                                        @if ($transaction->trx_type == 'IN')
                                            <span class="badge badge-success">
                                                Stock In
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                Stock Out
                                            </span>
                                        @endif

                                    </td>

                                    <td>
                                        {{ number_format($transaction->trx_qty) }}
                                    </td>

                                    <td style="max-width:250px;">

                                        {{ \Illuminate\Support\Str::limit($transaction->trx_notes, 40) }}

                                    </td>

                                    <td style="white-space: nowrap;">

                                        <a href="{{ route('transactions.edit', $transaction->trx_id) }}"
                                            class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('transactions.destroy', $transaction->trx_id) }}"
                                            method="POST" class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this transaction?')">

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
