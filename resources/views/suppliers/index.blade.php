@extends('layouts.app')

@section('page.header')
    <div class="page-header">
        <h4 class="page-title">Suppliers</h4>

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
                <a href="#">Suppliers</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Supplier List</h4>

                <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-round ms-auto">

                    <i class="fa fa-plus"></i>
                    Add Supplier

                </a>
            </div>
        </div>

        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fa fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if ($suppliers->isEmpty())
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i>
                    No supplier data available.
                </div>
            @else
                <div class="table-responsive">

                    <table id="supplier-table" class="display table table-striped table-hover">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Supplier Code</th>
                                <th>Supplier Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($suppliers as $supplier)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <strong>{{ $supplier->sup_kode }}</strong>
                                    </td>

                                    <td>{{ $supplier->sup_nama }}</td>

                                    <td>{{ $supplier->sup_telp }}</td>

                                    <td>{{ $supplier->sup_email }}</td>

                                    <td>{{ $supplier->sup_alamat }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-1">

                                            <a href="{{ route('suppliers.edit', $supplier->sup_id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('suppliers.destroy', $supplier->sup_id) }}"
                                                method="POST" class="d-inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this supplier?')">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>
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
