@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Catat Transaksi Stok</h4>

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
            <a href="{{ route('transactions.index') }}">Transactions</a>
        </li>

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">Catat Transaksi</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Catat Transaksi Stok</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_id">Produk <span class="text-danger">*</span></label>
                        <select id="product_id" name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->product_id }}">{{ $product->product_code }} - {{ $product->product_name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="movement_type">Tipe Transaksi <span class="text-danger">*</span></label>
                        <select id="movement_type" name="movement_type" class="form-control @error('movement_type') is-invalid @enderror" required>
                            <option value="">Pilih Tipe</option>
                            <option value="IN">IN (Barang Masuk)</option>
                            <option value="OUT">OUT (Barang Keluar)</option>
                        </select>
                        @error('movement_type')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="qty_change">Jumlah (unit) <span class="text-danger">*</span></label>
                        <input type="number" id="qty_change" name="qty_change" class="form-control @error('qty_change') is-invalid @enderror" placeholder="0" required>
                        @error('qty_change')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transaction_date">Tanggal & Waktu <span class="text-danger">*</span></label>
                        <input type="datetime-local" id="transaction_date" name="transaction_date" class="form-control @error('transaction_date') is-invalid @enderror" required>
                        @error('transaction_date')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Keterangan</label>
                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Masukkan keterangan transaksi"></textarea>
                @error('description')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Transaksi
                </button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
