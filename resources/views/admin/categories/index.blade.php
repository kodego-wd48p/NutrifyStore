@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                    <h4 class="card-title">Product Categories</h4>
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
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if($category->description)
                                        {{ $category->description }}
                                    @else
                                        <i class="text-muted">No description available</i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/categories/' . $category->id) }}" role="button" class="btn btn-primary btn-xs"><i class="mdi mdi-pencil"></i></a>
                                    <button type="button" class="btn btn-danger btn-xs"><i class="mdi mdi-delete-forever"></i></button>
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