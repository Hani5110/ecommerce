@extends('layouts.app')

@section('content')
    <header class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold mb-1">Product Inventory</h2>
            <p class="text-muted m-0">Manage your store products and stock levels</p>
        </div>
        <a href="{{ url('categories/create') }}" class="btn btn-add">
            <i class="bi bi-plus-lg me-2"></i> New Category
        </a>
    </header>

    <div class="card border-0">
        <div class="card-body p-0">
            <div class="table-responsive table-container">
                <table class="table table-hover m-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Details</th>
                          
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-muted fw-medium">#{{ $category->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                            width="50" height="50" class="rounded-3 product-img me-3">
                                        <span class="fw-semibold">{{ $category->name }}</span>
                                    </div>
                                </td>
                               
                               
                                <td class="text-end">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="action-btn edit-btn me-1">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn"
                                            onclick="return confirm('Delete this category?')">
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

    @if ($categories->isEmpty())
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
