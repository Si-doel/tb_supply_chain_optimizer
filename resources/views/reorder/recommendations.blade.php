@extends('layouts.app')

@section('page.header')
<div class="page-header">
    <h4 class="page-title">Reorder Recommendations</h4>

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
            <a href="#">Reorder Management</a>
        </li>

        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>

        <li class="nav-item">
            <a href="#">Reorder Recommendations</a>
        </li>
    </ul>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        reorder recommendations page
    </div>
</div>
@endsection