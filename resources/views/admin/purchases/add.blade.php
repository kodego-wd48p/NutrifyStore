@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card ">
            <div class="card p-4">
                <div class="card-body ">
                    <h4 class="card-title">New Purchase</h4>
                    <p class="card-description">Input new purchase to add stocks</p>
                    <form method="POST" action="{{ url('admin/purchases') }}">
                        @csrf
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="select2-single w-100">
                                <option value="delivered">Delivered / Received</option>
                                <option value="ordered">Ordered</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select id="product_selector" class="select2-product-search w-100">
                                <option></option>
                                @foreach($products as $product)
                                    <option value="{{ $product }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="table-responsive">
                                <table id="products" class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Expiration</th>
                                            <th>Cost</th>
                                            <th>Quantity</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ url('admin/purchases') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-scripts')
<script src="{{ url('admin/js/purchases.js') }}"></script>
@endsection
