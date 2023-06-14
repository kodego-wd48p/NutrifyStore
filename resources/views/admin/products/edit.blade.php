@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card ">
        <div class="card p-4">
            <div class="card-body ">
                <h4 class="card-title">Update Product</h4>
                <p class="card-description">Update existing product</p>
                <form method="POST" action="{{ url('admin/products/' . $product->id) }}" enctype="multipart/form-data">
                    @method('patch')
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea placeholder="Description" class="form-control" name="description" id="description" rows="4">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="select2-single w-100">
                            <option></option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($category->id === old('category_id') || $category->id === $product->category_id) ? ' selected="selected"' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="number" class="form-control" name="cost" id="cost" placeholder="Cost" value="{{ $product->cost }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" name="image" class="file-upload-default" accept="image/*">
                        <div class="input-group col-xs-12">
                            <input type="text" name="image-placeholder" class="form-control image" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse image btn btn-primary" type="button">Choose File</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ url('admin/products') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
