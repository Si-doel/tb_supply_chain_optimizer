@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Edit Product</h4>

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
            <a href="#">Edit</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Edit Product</h4>
    </div>
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong><i class="fa fa-exclamation-triangle"></i> Validation Error!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->prd_id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prd_kode">Product Code <span class="text-danger">*</span></label>
                        <input type="text" id="prd_kode" name="prd_kode"
                               class="form-control @error('prd_kode') is-invalid @enderror"
                               value="{{ old('prd_kode', $product->prd_kode) }}" required>
                        @error('prd_kode')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prd_nama">Product Name <span class="text-danger">*</span></label>
                        <input type="text" id="prd_nama" name="prd_nama"
                               class="form-control @error('prd_nama') is-invalid @enderror"
                               value="{{ old('prd_nama', $product->prd_nama) }}" required>
                        @error('prd_nama')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sup_id">Supplier <span class="text-danger">*</span></label>
                        <select id="sup_id" name="sup_id"
                                class="form-control @error('sup_id') is-invalid @enderror" required>
                            <option value="">-- Select Supplier --</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->sup_id }}"
                                    {{ old('sup_id', $product->sup_id) == $supplier->sup_id ? 'selected' : '' }}>
                                    {{ $supplier->sup_kode }} - {{ $supplier->sup_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('sup_id')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="prd_stok">Current Stock <span class="text-danger">*</span></label>
                        <input type="number" id="prd_stok" name="prd_stok"
                               class="form-control @error('prd_stok') is-invalid @enderror"
                               value="{{ old('prd_stok', $product->prd_stok) }}"
                               min="0" required>
                        @error('prd_stok')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stok_min">Minimum Stock <span class="text-danger">*</span></label>
                        <input type="number" id="stok_min" name="stok_min"
                               class="form-control @error('stok_min') is-invalid @enderror"
                               value="{{ old('stok_min', $product->stok_min) }}"
                               min="0" required>
                        @error('stok_min')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Changes
                </button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
