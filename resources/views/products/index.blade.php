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
        <h4 class="card-title">Daftar Produk</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>
    <div class="card-body">
        @if(count($products) == 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Belum ada data produk. Klik tombol "Tambah Produk" untuk menambahkan data baru.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Supplier</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><strong>{{ $product->product_code }}</strong></td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge badge-info">Supplier #{{ $product->supplier_id }}</span>
                            </td>
                            <td>{{ $product->unit }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product->product_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('products.destroy', $product->product_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin?')">
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