@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <div class="card-body">
                <h4 class="card-title">Purchases</h4>
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
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ date('F d, Y h:i A', strtotime($purchase->created_at)) }}</td>
                            <td>{{ $purchase->status }}</td>
                            <td>
                                <a href="{{ url('admin/purchases/' . $purchase->id) }}" role="button" class="btn btn-primary btn-xs"><i class="mdi mdi-pencil"></i></a>
                                <a href="{{ url('admin/purchases/view/' . $purchase->id) }}" role="button" class="btn btn-info btn-xs"><i class="mdi mdi-eye"></i></a>
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