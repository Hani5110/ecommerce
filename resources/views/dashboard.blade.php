@extends('layouts.app')

@section('content')

<h2>Dashboard</h2>

<div class="row mt-4">

    <div class="col-md-4">
        <div class="card shadow p-3">
            <h5>Total Products</h5>
            <h3>{{ \App\Models\Product::count() }}</h3>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-3">
            @php
$totalOrders = \App\Models\Order::count();
@endphp
            <h5>Total Orders</h5>
           <h3>{{ $totalOrders }}</h3>
        </div>
    </div>

</div>


@endsection