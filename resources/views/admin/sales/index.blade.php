@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <div class="card-body">
                <h4 class="card-title">Sales & Orders</h4>
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
                            <th>Date Placed</th>
                            <th>Customer</th>
                            <th>Sale Status</th>
                            <th>Grand Total</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>{{ date('F d, Y h:i A', strtotime($sale->created_at)) }}</td>
                            <td>{{ $sale->customer->first_name . ' ' . $sale->customer->last_name }}</td>
                            <td>
                                @if($sale->status == 'ordered')
                                    <button type="button" data-status="{{ $sale->status }}" data-id="{{ $sale->id }}" class="btn btn-sm btn-warning btn-update-status">Ordered</button>
                                @elseif($sale->status == 'in_transit')
                                    <button type="button" data-status="{{ $sale->status }}" data-id="{{ $sale->id }}" class="btn btn-sm btn-info btn-update-status">In Transit</button>
                                @else
                                    <button type="button" data-status="{{ $sale->status }}" data-id="{{ $sale->id }}" class="btn btn-sm btn-success btn-update-status">Delivered</button>
                                @endif
                            </td>
                            <td>P {{ number_format($sale->grand_total, 2) }}</td>
                            <td>
                                @if($sale->payment_status == 'pending')
                                    <button type="button" data-status="{{ $sale->payment_status }}" data-id="{{ $sale->id }}" class="btn btn-sm btn-danger btn-update-payment-status">Pending</button>
                                @else
                                    <button type="button" data-status="{{ $sale->payment_status }}" data-id="{{ $sale->id }}" class="btn btn-sm btn-success btn-update-payment-status">Paid</button>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('admin/sales/view/' . $sale->id) }}" class="btn btn-xs btn-info"><i class="mdi mdi-eye"></i></a>
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

@section('page-scripts')
<script type="text/javascript" src="{{ url('admin/js/sales.js') }}"></script>
@endsection