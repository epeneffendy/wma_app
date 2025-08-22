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
                        <h5 class="card-title m-0 me-2">Weighted Moving Average</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-label" style="font-weight: bold">Date</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label">{{$data->date}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-label" style="font-weight: bold">Year</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label">{{$data->year}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-label" style="font-weight: bold">Product</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label">{{'('. $data->product_code .') - '.   $data->product->name}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-label" style="font-weight: bold">Weighted Average</div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-label">{{number_format($data->weighted_average, 2)}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Details Weighted Moving Average</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-light">
                                <tr>
                                    <th class="text-truncate">Periode</th>
                                    <th class="text-truncate">Actual Periode</th>
                                    <th class="text-truncate">Weight</th>
                                    <th class="text-truncate">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($details as $item)
                                    <tr>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->actual_periode}}</td>
                                        <td>{{$item->weight}}</td>
                                        <td>{{$item->total}}</td>
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
