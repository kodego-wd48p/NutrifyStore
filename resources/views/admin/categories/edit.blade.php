@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                  <h4 class="card-title">Update Category</h4>
                  <p class="card-description">
                    Update existing product category
                  </p>
                  @if($category)
                  <form method="POST" action={{ url('admin/categories/' . $category->id) }}>
                    @method('patch')
                    @csrf
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                      @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                      @endforeach
                    </div>
                    @endif
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Category Name *</label>
                      <div class="col-sm-9">
                        <input name="name" type="text" class="form-control" id="name" placeholder="Category Name" value="{{ $category->name }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <textarea placeholder="Description (Optional)" class="form-control" name="description">{{  $category->description }}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <a href="{{ url('admin/categories') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                    </div>
                  </form>
                  @else
                    <i class="mdi mdi-information-outline"></i> Category not found
                  @endif
                </div>
            </div>
        </div>
    </div>
@endsection