@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Add Transaction</h4>

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
            <a href="#">Add</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Add Transaction</h4>
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

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="prd_id">Product <span class="text-danger">*</span></label>
                        <select id="prd_id" name="prd_id"
                                class="form-control @error('prd_id') is-invalid @enderror" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->prd_id }}"
                                    {{ old('prd_id') == $product->prd_id ? 'selected' : '' }}>
                                    {{ $product->prd_kode }} - {{ $product->prd_nama }}
                                    (Stock: {{ $product->prd_stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('prd_id')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="trx_type">Transaction Type <span class="text-danger">*</span></label>
                        <select id="trx_type" name="trx_type"
                                class="form-control @error('trx_type') is-invalid @enderror" required>
                            <option value="">-- Select Type --</option>
                            <option value="IN" {{ old('trx_type') == 'IN' ? 'selected' : '' }}>
                                IN (Stock In)
                            </option>
                            <option value="OUT" {{ old('trx_type') == 'OUT' ? 'selected' : '' }}>
                                OUT (Stock Out)
                            </option>
                        </select>
                        @error('trx_type')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="trx_qty">Quantity <span class="text-danger">*</span></label>
                        <input type="number" id="trx_qty" name="trx_qty"
                               class="form-control @error('trx_qty') is-invalid @enderror"
                               value="{{ old('trx_qty') }}"
                               min="1" placeholder="0" required>
                        @error('trx_qty')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="trx_date">Transaction Date <span class="text-danger">*</span></label>
                        <input type="date" id="trx_date" name="trx_date"
                               class="form-control @error('trx_date') is-invalid @enderror"
                               value="{{ old('trx_date', date('Y-m-d')) }}" required>
                        @error('trx_date')
                            <span class="text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="trx_notes">Notes</label>
                <textarea id="trx_notes" name="trx_notes"
                          class="form-control @error('trx_notes') is-invalid @enderror"
                          rows="3" placeholder="Enter transaction notes">{{ old('trx_notes') }}</textarea>
                @error('trx_notes')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Save Transaction
                </button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
