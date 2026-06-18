@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Add Supplier</h4>

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
            <a href="#">Add</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Add Supplier</h4>
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

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="sup_kode">Supplier Code <span class="text-danger">*</span></label>
                <input type="text" id="sup_kode" name="sup_kode"
                       class="form-control @error('sup_kode') is-invalid @enderror"
                       value="{{ old('sup_kode') }}"
                       placeholder="Example: SUP001" required>
                @error('sup_kode')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_nama">Supplier Name <span class="text-danger">*</span></label>
                <input type="text" id="sup_nama" name="sup_nama"
                       class="form-control @error('sup_nama') is-invalid @enderror"
                       value="{{ old('sup_nama') }}"
                       placeholder="Enter supplier name" required>
                @error('sup_nama')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_telp">Phone <span class="text-danger">*</span></label>
                <input type="tel" id="sup_telp" name="sup_telp"
                       class="form-control @error('sup_telp') is-invalid @enderror"
                       value="{{ old('sup_telp') }}"
                       placeholder="Example: 081234567890" required>
                @error('sup_telp')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_email">Email</label>
                <input type="email" id="sup_email" name="sup_email"
                       class="form-control @error('sup_email') is-invalid @enderror"
                       value="{{ old('sup_email') }}"
                       placeholder="Enter supplier email">
                @error('sup_email')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="sup_alamat">Address</label>
                <textarea id="sup_alamat" name="sup_alamat"
                          class="form-control @error('sup_alamat') is-invalid @enderror"
                          rows="3" placeholder="Enter supplier address">{{ old('sup_alamat') }}</textarea>
                @error('sup_alamat')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save
                </button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
