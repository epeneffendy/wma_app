@extends('layouts.admin.master')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row gy-4">
            <!-- Congratulations card -->
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-1">Welcome {{$user->name}}</h4>
                        <p class="pb-0">{{$user->roles}}</p>
                        <a href="javascript:;" class="btn btn-sm btn-primary">View Profile</a>
                    </div>

                    @if($user->gender == 'L')
                        <img
                            src="{{asset('admin/assets/img/illustrations/illustration-2.png')}}"
                            class="position-absolute card-img-position scaleX-n1-rtl bottom-0 w-auto end-0 me-3 me-xl-0 me-xxl-3 pe-2"
                            width="81"
                            alt="view sales"/>
                    @else
                        <img
                            src="{{asset('admin/assets/img/illustrations/illustration-1.png')}}"
                            class="position-absolute card-img-position scaleX-n1-rtl bottom-0 w-auto end-0 me-3 me-xl-0 me-xxl-3 pe-2"
                            width="81"
                            alt="view sales"/>
                    @endif

                </div>
            </div>
            <!--/ Congratulations card -->

            <!-- Transactions -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">Transactions in Month</h5>
                            <div class="dropdown">
                                <button
                                    class="btn p-0"
                                    type="button"
                                    id="transactionID"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical mdi-24px"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-warning rounded shadow">
                                            <i class="mdi mdi-cellphone-link mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Product</div>
                                        <h5 class="mb-0">{{$data_product}}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-primary rounded shadow">
                                            <i class="mdi mdi-trending-up mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Sales</div>
                                        <h5 class="mb-0">{{ $data_sales_transaction }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="avatar">
                                        <div class="avatar-initial bg-success rounded shadow">
                                            <i class="mdi mdi-sitemap-outline mdi-24px"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="small mb-1">Item Transaction</div>
                                        <h5 class="mb-0">{{$data_item_transaction}}</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--/ Transactions -->

            <!-- Sales by Countries -->
            <div class="col-xl-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Items Per Transaction</h5>
                    </div>
                    <div class="card-body">
                        @foreach($data_item_per_transaction as $item)
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center mb-4">
                                    <div>
                                        <div class="d-flex align-items-center gap-1 mb-1">
                                            <h6 class="mb-0">{{$item['product_name']}}</h6>
                                            <i class="ri-arrow-up-s-line ri-24px text-success"></i>
                                        </div>
                                        <p class="mb-0">{{$item['category_name']}}</p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="mb-1">{{$item['item_transaction']}}</h6>
                                    <small class="text-muted">Sales</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!--/ Sales by Countries -->

            <!-- Data Tables -->
            <div class="col-xl-8">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Weighted Moving Average</h5>
                    </div>
                    <div class="card-body">
                        <div class="card overflow-hidden">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th class="text-truncate">Periode</th>
                                        <th class="text-truncate">Year</th>
                                        <th class="text-truncate">Actual WMA</th>
                                        <th class="text-truncate">Weighted Average</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data_wma as $item)
                                        <tr>
                                            <td>{{\App\Models\WeightedMovingAverage::periode($item['periode'])}}</td>
                                            <td class="text-truncate">{{$item['year']}}</td>
                                            <td class="text-truncate">{{number_format($item['actual_wma'])}}</td>
                                            <td>{{$item['weighted_average']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Data Tables -->


        </div>
    </div>

@endsection
