@extends('layouts.admin.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0 me-2">Warehouse Transaction</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="category_code">Category</label>
                        <div class="col-sm-6">
                            <select class="form-select" id="category_code" name="category_code" aria-label="Category">
                                <option value="0">-- Select Category --</option>
                                @foreach($category as $item)
                                    <option value="{{$item->code}}"> {{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="product_code">Product</label>
                        <div class="col-sm-6">
                            <select class="form-select" id="product_code" name="product_code" aria-label="Product">
                                <option value="0">-- Select Product --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="transaction_date">Transaction Date</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="date" id="transaction_date_start"
                                   name="transaction_date_start" value="{{date('d/m/Y')}}"/>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control" type="date" id="transaction_date_end"
                                   name="transaction_date_end" value="{{date('d/m/Y')}}"/>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary me-2" id="fetch_stock"><span
                                class="tf-icons mdi mdi-magnify me-1"></span>Search
                        </button>
                    </div>

                </div>
            </div>
        </div>
        @endsection
        @section('scripts')
            <script>
                const base_prefix = "/administrator/warehouse";

                $(document).ready(function () {
                    console.log("ini halaman manajemen stok");
                });

                $('#fetch_stock').click(function () {
                    let success = true;
                    let message = 'validation success';

                    let category = $('#category_code').val();
                    let transaction_date_start = $('#transaction_date_start').val();
                    let transaction_date_end = $('#transaction_date_end').val();

                    if (transaction_date_start == '' && transaction_date_end == '') {
                        success = false;
                        message = 'Transaction Date cannot be empty!';
                    }

                    if (category == 0) {
                        success = false;
                        message = 'Unit or Category cannot be empty!';
                    }

                    if (success) {
                        console.log("okeee");
                    } else {
                        swal('warning', message, 'error');
                    }
                });

                $('#category_code').change(function () {
                    let category = $('#category_code').val();
                    getProductByCategory(category)
                });

                async function getProductByCategory(category) {
                    $.ajax({
                        url: base_prefix + '/warehouse_transaction/get_product_by_category/' + category,
                        type: 'get',
                        success: function (result) {
                            let selectbox = $("#product_code");
                            selectbox.children().remove();
                            if (result.length > 0) {
                                selectbox.append($(new Option("-- Select Product --", "", true, true)).attr(
                                        "disabled",
                                        true
                                    )
                                );

                                result.forEach((product, key) => {
                                    let option = new Option(
                                        product.code + ' - ' + product.name,
                                        product.code,
                                        false,
                                        false
                                    );
                                    $(option).attr("data-code", product.code);
                                    selectbox.append(option)
                                });
                            } else {
                                selectbox.append(new Option("-- Product Not Found --", ""));
                            }

                        }
                    });
                }
            </script>
@endsection
