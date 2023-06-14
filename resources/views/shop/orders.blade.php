@extends('shop.layouts.app')

@section('content')
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <thead class="table_head">
                                <tr>
                                    <th class="column-1">Order #</th>
                                    <th class="column-1">Date Placed</th>
                                    <th class="column-1">Items</th>
                                    <th class="column-1">Grand Total</th>
                                    <th class="column-1">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="column-1">#{{ $order->id }}</td>
                                        <td class="column-1">
                                            {{ date('F j, Y h:i A', strtotime($order->created_at)) }}
                                        </td>
                                        <td class="column-1">
                                            @foreach ($order->saleProducts as $saleProduct)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    {{ $saleProduct->product->name }}
                                                    </div>
                                                    <div class="col-md-12">
                                                    {{ $saleProduct->quantity }} x P {{ number_format($saleProduct->subtotal, 2) }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </td>
                                        <td class="column-1">
                                            P {{ number_format($order->grand_total, 2) }}
                                        </td>
                                        <td class="column-1">
                                            @if ($order->status == 'ordered')
                                            <span class="badge badge-warning"><i class="fa fa-clock-o"></i> Ordered</span>
                                            @elseif ($order->status == 'in_transit')
                                            <span class="badge badge-info"><i class="fa fa-truck"></i> In Transit</span>
                                            @else
                                            <span class="badge badge-success"><i class="fa fa-check"></i> Delivered</span>
                                            @endif
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
</div>
@endsection