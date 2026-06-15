@extends('layouts.app')

@section('page.header')

<div class="page-header">
    <h4 class="page-title">Reorder Drafts</h4>

```
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
        <a href="#">Reorder Drafts</a>
    </li>
</ul>
```

</div>
@endsection

@section('content')

<div class="card">

```
<div class="card-header">
    <h4 class="card-title">
        Reorder Draft List
    </h4>
</div>

<div class="card-body">

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($drafts->isEmpty())

        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            No reorder draft available.
        </div>

    @else

        <div class="table-responsive">

            <table class="table table-striped table-hover">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Notes</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($drafts as $draft)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $draft->product->prd_kode ?? '-' }}
                            </td>

                            <td>
                                {{ $draft->product->prd_nama ?? '-' }}
                            </td>

                            <td>
                                {{ $draft->supplier->sup_nama ?? '-' }}
                            </td>

                            <td>
                                {{ number_format($draft->rod_qty) }}
                            </td>

                            <td>
                                {{ $draft->rod_notes }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @endif

</div>
```

</div>

@endsection
