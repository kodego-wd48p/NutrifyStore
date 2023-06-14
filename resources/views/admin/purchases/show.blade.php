@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card ">
            <div class="card p-4">
                <div class="card-body ">
                    <h4 class="card-title">Purchase Details</h4>
                    <div class="form-group">
                        <span class="badge badge-info">{{ $purchase->status }}</span>
                    </div>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Expiration</th>
                                        <th>Unit Cost</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchase->purchaseProducts as $purchaseProduct)
                                    <tr>
                                        <td>{{ $purchaseProduct->product->name }}</td>
                                        <td>{{ $purchaseProduct->expiration ? $purchaseProduct->expiration : 'No expiration' }}</td>
                                        <td>{{ $purchaseProduct->cost }}</td>
                                        <td>{{ $purchaseProduct->quantity }}</td>
                                        <td>{{ $purchaseProduct->subtotal }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection