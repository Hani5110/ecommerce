@extends('layouts.app')

@section('content')

<div class="container mt-4">
      <a href="{{ route('admin.orders') }}" class="btn btn-secondary mb-3">
Back to Orders
</a>

<div class="card shadow p-4">
  

<h4 class="mb-4">Order Detail</h4>

<div class="row">

<div class="col-md-6">

<p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>

<p><strong>Email:</strong> {{ $order->email }}</p>

<p><strong>Phone:</strong> {{ $order->phone }}</p>

<p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>

</div>

<div class="col-md-6">

<p><strong>Address:</strong> {{ $order->address }}</p>

<p><strong>City:</strong> {{ $order->city }}</p>

<p><strong>Postal Code:</strong> {{ $order->postal_code }}</p>
</div>

</div>

<hr>

<h5>Ordered Products</h5>

<table class="table table-bordered mt-3">

<thead class="table-dark">

<tr>
<th>Product</th>
<th>Quantity</th>
<th>Price</th>
<th>Total</th>
</tr>

</thead>

<tbody>

@foreach($order->items as $item)

<tr>

<td>{{ $item->product->name }}</td>

<td>{{ $item->quantity }}</td>

<td>${{ $item->price }}</td>

<td>${{ $item->price * $item->quantity }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endsection