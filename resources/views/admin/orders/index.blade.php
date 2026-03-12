@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            background:#f4f6f9;
        }

        .card{
            border:none;
            border-radius:10px;
            box-shadow:0 3px 10px rgba(0,0,0,0.08);
        }

        .table thead{
            background:#343a40;
            color:white;
        }

        .table tbody tr:hover{
            background:#f1f1f1;
        }

        .page-title{
            font-weight:600;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">
        <h3 class="page-title ">Orders Management</h3>
    </div>

    <div class="card p-4">

        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Total Order</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
            </thead>

          <tbody>

@foreach($orders as $order)

<tr class="clickable-row"
    data-url="{{ route('admin.orders.show', $order->id) }}"
    style="cursor:pointer">

<td>{{ $order->id }}</td>

<td>{{ $order->first_name }} {{ $order->last_name }}</td>

<td>{{ $order->email }}</td>

<td>
<span class="badge bg-success">
${{ $order->total_amount }}
</span>
</td>

<td onclick="event.stopPropagation();">

<form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">

@csrf
@method('PUT')

<select name="status"
class="form-select
@if($order->status=='pending') bg-warning text-dark
@elseif($order->status=='dispatched') bg-info text-dark
@elseif($order->status=='delivered') bg-success text-white
@elseif($order->status=='returned') bg-danger text-white
@endif"
onchange="this.form.submit()">

<option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
Pending
</option>

<option value="dispatched" {{ $order->status == 'dispatched' ? 'selected' : '' }}>
Dispatched
</option>

<option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>
Delivered
</option>

<option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>
Returned
</option>

</select>

</form>

</td>
<td onclick="event.stopPropagation();">

<form action="{{ route('admin.orders.delete',$order->id) }}" method="POST">
@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Delete
</button>

</form>

</td>

</tr>

@endforeach

</tbody>
        </table>

    </div>

</div>

</body>
</html>
<style>
    .clickable-row:hover{
    background:#f5f5f5;
}
</style>
<script>

document.querySelectorAll('.status-dropdown').forEach(function(dropdown){

dropdown.addEventListener('change', function(){

let orderId = this.dataset.id;
let status = this.value;

fetch('/admin/orders/status/' + orderId, {

method: 'POST',

headers: {
'Content-Type': 'application/json',
'X-CSRF-TOKEN': '{{ csrf_token() }}'
},

body: JSON.stringify({
status: status
})

})
.then(response => response.json())
.then(data => {

if(data.success){
console.log('Status updated');
}

});

});

});

</script>
@endsection