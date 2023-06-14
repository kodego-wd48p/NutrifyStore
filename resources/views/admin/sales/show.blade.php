@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card ">
            <div class="card p-4">
                <div class="card-body ">
                    <h4 class="card-title">Sale Details</h4>
                    <div class="form-group">
                        @if($sale->status === 'ordered')
                            <button type="button" class="btn btn-warning btn-sm btn-update-status">Ordered</button>
                        @elseif($sale->status === 'in_transit')
                            <button type="button" class="btn btn-info btn-sm btn-update-status">In Transit</button>
                        @else
                            <button type="button" class="btn btn-success btn-sm btn-update-status">Delivered</button>
                        @endif

                        @if($sale->payment_status === 'pending')
                            <button type="button" class="btn btn-danger btn-sm btn-update-status">Pending Payment</button>
                        @else
                            <button type="button" class="btn btn-success btn-sm btn-update-status">Paid</button>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sale->saleProducts as $saleProduct)
                                    <tr>
                                        <td>{{ $saleProduct->product->name }}</td>
                                        <td>{{ number_format($saleProduct->quantity) }}</td>
                                        <td>P {{ number_format($saleProduct->price, 2) }}</td>
                                        <td>P {{ number_format($saleProduct->subtotal) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-bold">P {{ number_format($sale->grand_total, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection