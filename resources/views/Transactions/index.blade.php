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

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">Product Transactions</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        Supplier Page
    </div>
</div>
@endsection