@extends('layouts.admin.master')

@section('title')
    Product Transaction
@endsection

@section('content')
    <div class="row gy-4">
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">
                    <h4 class="card-header">Product Transaction</h4>
                    <div class="card-body pt-2 mt-1">
                        <form action="{{route('admin.transaction.product_retur.store')}}" method="post">
                            @csrf
                            @if (session('errors'))
                                <div class="alert alert-danger">
                                    {{session('errors')}}
                                </div>
                            @endif
                            <input class="form-control" type="hidden" id="editable" name="editable"
                                   value="{{($editable) ? 'true' : 'false'}}" placeholder="Name"/>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="product_code">Product</label>
                                <div class="col-sm-6">
                                    <select class="form-select" id="product_code" name="product_code" aria-label="Product">
                                        <option value="0">-- Select Product --</option>
                                        @foreach($list_products as $item)
                                            <option value="{{$item->code}}">{{$item->code .' - '.$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Transaction Date</label>
                                <div class="col-sm-3">
                                    <input class="form-control"  type="text" id="transaction_date" name="transaction_date" value="{{date('Y-m-d')}}" readonly />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Transaction Date</label>
                                <div class="col-sm-2">
                                    <input class="form-control" type="number" id="qty" name="qty" value="" placeholder="QTY"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Description</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" type="text" id="description" name="description"></textarea>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2"><span
                                        class="tf-icons mdi mdi-content-save-check me-1"></span>Save Retur
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
