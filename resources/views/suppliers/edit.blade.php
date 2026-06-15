@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Edit Supplier</h4>

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
            <a href="{{ route('suppliers.index') }}">Suppliers</a>
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
        <h4 class="card-title">Form Edit Supplier</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('suppliers.update', $supplier->sup_id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="sup_kode">Kode Supplier <span class="text-danger">*</span></label>
                <input type="text" id="sup_kode" name="sup_kode" class="form-control @error('sup_kode') is-invalid @enderror" value="{{ $supplier->sup_kode }}" required>
                @error('sup_kode')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_nama">Nama Supplier <span class="text-danger">*</span></label>
                <input type="text" id="sup_nama" name="sup_nama" class="form-control @error('sup_nama') is-invalid @enderror" value="{{ $supplier->sup_nama }}" required>
                @error('sup_nama')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_telp">Telepon <span class="text-danger">*</span></label>
                <input type="tel" id="sup_telp" name="sup_telp" class="form-control @error('sup_telp') is-invalid @enderror" value="{{ $supplier->sup_telp }}" required>
                @error('sup_telp')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_email">Email</label>
                <input type="email" id="sup_email" name="sup_email" class="form-control @error('sup_email') is-invalid @enderror" value="{{ $supplier->sup_email ?? '' }}">
                @error('sup_email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_alamat">Alamat</label>
                <textarea id="sup_alamat" name="sup_alamat" class="form-control @error('sup_alamat') is-invalid @enderror" rows="3">{{ $supplier->sup_alamat ?? '' }}</textarea>
                @error('sup_alamat')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
