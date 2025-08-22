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
                                    <th class="text-truncate">Periode</th>
                                    <th class="text-truncate">Year</th>
                                    <th class="text-truncate">Product</th>
                                    <th class="text-truncate">Weighted Average</th>
                                    <th class="text-truncate">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->year}}</td>
                                        <td>{{'('. $item->product_code .') - '.   $item->product->name}}</td>
                                        <td>{{number_format($item->weighted_average)}}</td>
                                        <td><a href="{{route('admin.wma.weighted_moving_average.details', ['id'=>$item->id])}}"
                                               class="btn btn-success"><i class="mdi mdi-format-list-bulleted"></i></a></td>
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
