@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <div class="card-body">
                <h4 class="card-title">Products</h4>
                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th class="col-3">Description</th>
                            <th>Category</th>
                            <th>Available Quantity</th>
                            <th>Cost</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td><img class="square-36" src="{{ asset('storage/uploads/products/' . $product->image) }}" /></td>
                            <td>{{ $product->name }}</td>
                            <td class="clip-content">{{ $product->description }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ number_format($product->quantity) }}</td>
                            <td>{{ number_format($product->cost, 2) }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>
                                <a href="{{ url('admin/products/edit/' . $product->id) }}" role="button" class="btn btn-primary btn-xs">
                                    <i class="mdi mdi-pencil"></i>
                                </a>
                                <a href="{{ url('admin/products/delete/' . $product->id) }}" type="button" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this?')">
                                    <i class="mdi mdi-delete-forever"></i>
                                </a>        
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection