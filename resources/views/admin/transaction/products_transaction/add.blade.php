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
                        <form action="{{route('admin.transaction.products_transaction.store')}}" method="post">
                            @csrf
                            @if (session('errors'))
                                <div class="alert alert-danger">
                                    {{session('errors')}}
                                </div>
                            @endif
                            <input class="form-control" type="hidden" id="editable" name="editable"
                                   value="{{($editable) ? 'true' : 'false'}}" placeholder="Name"/>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="product_id">Product</label>
                                <div class="col-sm-6">
                                    <select class="form-select" id="product_id" name="product_id" aria-label="Product">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="unit_id">Unit Product</label>
                                <div class="col-sm-6">
                                    <select class="form-select" id="unit_id" name="unit_id" aria-label="Unit">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="category_id">Category Product</label>
                                <div class="col-sm-6">
                                    <select class="form-select" id="category_id" name="category_id" aria-label="Category">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Transaction Date</label>
                                <div class="col-sm-3">
                                    <input class="form-control"  type="text" id="transaction_date" name="transaction_date" value="{{date('d/m/Y')}}" disabled/>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2"><span
                                        class="tf-icons mdi mdi-content-save-check me-1"></span>Save User
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
