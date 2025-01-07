@extends('layouts.admin.master')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">List Transaction</h5>
                        <a href="{{route('admin.transaction.products_transaction.add_acceptance')}}"
                           class="btn btn-primary"><span
                                class="tf-icons mdi mdi mdi-swap-horizontal-bold me-1"></span>Add Transaction</a>
                    </div>
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        @if (session('errors'))
                            <div class="alert alert-danger">
                                {!! session('errors')->first() !!}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                <tr>
                                    <th class="text-truncate">Product</th>
                                    <th class="text-truncate">Unit</th>
                                    <th class="text-truncate">Category</th>
                                    <th class="text-truncate">Date</th>
                                    <th class="text-truncate">Qty</th>
                                    <th class="text-truncate">Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->product->code .' - '. $item->product->name}}</td>
                                        <td>{{$item->unit_code}}</td>
                                        <td>{{$item->category->name}}</td>
                                        <td>{{$item->transaction_date}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td>{{$item->transaction_type}}</td>
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
