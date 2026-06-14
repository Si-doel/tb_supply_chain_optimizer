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
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="card-title">Daftar Supplier</h4>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Supplier
        </a>
    </div>
    <div class="card-body">
        @if(count($suppliers) == 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Belum ada data supplier. Klik tombol "Tambah Supplier" untuk menambahkan data baru.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $key => $supplier)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>{{ $supplier->sup_kode }}</strong></td>
                            <td>{{ $supplier->sup_nama }}</td>
                            <td>{{ $supplier->sup_telp }}</td>
                            <td>{{ $supplier->sup_email ?? '-' }}</td>
                            <td>{{ $supplier->sup_alamat ?? '-' }}</td>
                            <td>
                                <a href="{{ route('suppliers.edit', $supplier->sup_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('suppliers.destroy', $supplier->sup_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i> Hapus
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