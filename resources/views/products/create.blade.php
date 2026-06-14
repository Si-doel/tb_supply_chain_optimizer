@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Tambah Produk</h4>

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
            <a href="{{ route('products.index') }}">Products</a>
        </li>

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">Tambah</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Tambah Produk</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_code">Kode Produk <span class="text-danger">*</span></label>
                        <input type="text" id="product_code" name="product_code" class="form-control @error('product_code') is-invalid @enderror" placeholder="Contoh: PRD001" required>
                        @error('product_code')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_name">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" id="product_name" name="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="Masukkan nama produk" required>
                        @error('product_name')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category">Kategori <span class="text-danger">*</span></label>
                        <select id="category" name="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="">Pilih Kategori</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Supplies">Supplies</option>
                            <option value="Tools">Tools</option>
                            <option value="Parts">Parts</option>
                        </select>
                        @error('category')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="supplier_id">Supplier <span class="text-danger">*</span></label>
                        <select id="supplier_id" name="supplier_id" class="form-control @error('supplier_id') is-invalid @enderror" required>
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->sup_id }}">{{ $supplier->sup_nama }}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="purchase_price">Harga Beli (Rp) <span class="text-danger">*</span></label>
                        <input type="number" id="purchase_price" name="purchase_price" class="form-control @error('purchase_price') is-invalid @enderror" placeholder="0" required>
                        @error('purchase_price')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selling_price">Harga Jual (Rp) <span class="text-danger">*</span></label>
                        <input type="number" id="selling_price" name="selling_price" class="form-control @error('selling_price') is-invalid @enderror" placeholder="0" required>
                        @error('selling_price')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit">Satuan <span class="text-danger">*</span></label>
                        <input type="text" id="unit" name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Contoh: pcs, box, kg" required>
                        @error('unit')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
