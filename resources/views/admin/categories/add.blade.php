@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">
                <div class="card-body">
                  <h4 class="card-title">New Category</h4>
                  <p class="card-description">
                    Add a new product category
                  </p>
                  <form method="POST" action={{ url('admin/categories') }}>
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
                        <input name="name" type="text" class="form-control" id="name" placeholder="Category Name" value="{{ old('name') }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="name" class="col-sm-3 col-form-label">Description</label>
                      <div class="col-sm-9">
                        <textarea placeholder="Description (Optional)" class="form-control" name="description">{{  old('description') }}</textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-right">
                            <a href="{{ url('admin/categories') }}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
@endsection