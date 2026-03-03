@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-1">Product Inventory</h2>
            <p class="text-muted m-0">Manage your store products and stock levels</p>
        </div>
        <a href="{{ url('products/create') }}" class="btn btn-add">
            <i class="bi bi-plus-lg me-2"></i> New Product
        </a>
    </header>

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive table-container">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Details</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td class="text-muted fw-medium">#{{ $product->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
@if(!empty($product->images))
 @foreach($product->images as $image) <img src="{{ asset('storage/'.$image) }}" 
 width="60" height="60" style="object-fit: cover; border-radius: 6px;">
  @endforeach 
  @else <span>No Image</span>
   @endif
                       <span class="fw-semibold">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="text-muted" style="max-width: 250px;">
                                    {{ Str::limit($product->description, 50) }}
                                </td>
                                <td class="fw-bold text-primary">${{ number_format($product->price, 2) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('products.edit', $product->id) }}" class="action-btn edit-btn me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn"
                                            onclick="return confirm('Delete this product?')">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($products->isEmpty())
        <div class="text-center py-5 mt-5">
            <i class="bi bi-box-seam text-muted" style="font-size: 4rem;"></i>
            <h4 class="mt-3 text-muted">No products found</h4>
            <p>Click "New Product" to start building your catalog.</p>
        </div>
    @endif

    <style>
        .card {
            border: none;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .table-container {
            border-radius: 20px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f1f5f9;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 18px;
            border: none;
        }

        .table tbody td {
            padding: 18px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .btn-add {
            background: var(--primary-gradient);
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            font-weight: 600;
            color: white;
            transition: all 0.3s;
        }

        .btn-add:hover {
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.5);
            transform: scale(1.02);
            color: white;
        }

        .action-btn {
            width: 35px;
            height: 35px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            transition: 0.2s;
            border: 1px solid #e2e8f0;
            background: #fff;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .edit-btn:hover {
            color: #6366f1;
            border-color: #6366f1;
        }

        .delete-btn:hover {
            color: #ef4444;
            border-color: #ef4444;
        }

        .product-img {
            object-fit: cover;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        .product-img:hover {
            transform: scale(1.5);
            cursor: zoom-in;
        }
    </style>
@endsection
