@extends('layouts.admin.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row gy-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title m-0 me-2">Weighted Moving Average</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="date">Date</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="date" id="date_periode"
                                   name="date_periode" value="{{date('d/m/Y')}}"/>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="periode">Product</label>
                        <div class="col-sm-6">
                            <select class="form-select" id="product" name="product" aria-label="Product">
                                <option value="0">-- Select Product --</option>
                                @foreach($list_products as $item)
                                    <option value="{{$item->code}}">{{$item->code .' - '.$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="total_days">Total Days</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="number" id="total_days" name="total_days"/>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="button" class="btn btn-primary me-2" id="fetch_wma"><span
                                class="tf-icons mdi mdi-magnify me-1"></span>Calculate WMA
                        </button>
                    </div>

                </div>
            </div>
            <br>
            <div id="show_calculate_wma"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const base_prefix = "/administrator/wma";

        $(document).ready(function () {
            console.log("ini halaman manajemen stok");

            $('#fetch_wma').click(function () {
                validationCalculateWma();
            });

            $(document).on("click", "#count_wma", function () {
                countWma();
            });
        });

        function countWma() {
            var $form = $("#show_data_actual");
            var data = getFormData($form);
            $.ajax({
                type: 'POST',
                url: base_prefix + '/weighted_moving_average/new_count_wma',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'form': data,
                    'date_periode': $('#date_periode').val(),
                    'total_days': $('#total_days').val(),
                    'product': $('#product').val(),
                }
            })
            redirect();
        }

        function redirect() {
            window.location.href = "{{ route('admin.wma.weighted_moving_average.list')}}";

        }

        function validationCalculateWma() {
            let success = true;
            let message = 'validation success';

            let date_periode = $('#date_periode').val();
            let total_days = $('#total_days').val();
            let year = $('#year').val();

            if (date_periode == 0) {
                success = false;
                message = 'Date cannot be empty!'
            }

            if (total_days == '') {
                success = false;
                message = 'Total Days cannot be empty!'
            }

            if (total_days != '' && total_days >= 8) {
                success = false;
                message = 'Total Days should not exceed 7!'
            }

            if (success) {
                let params = {
                    'date_periode': date_periode,
                    'total_days': total_days,
                }
                calculateWma(params)
            } else {
                swal('warning', message, 'warning');
            }
        }

        function calculateWma(params) {
            $.post(
                base_prefix + '/weighted_moving_average/calculate_wma_new',
                {
                    "_token": "{{ csrf_token() }}",
                    'date_periode': params.date_periode,
                    'total_days': params.total_days,
                },
                function (data) {
                    $('#show_calculate_wma').html('');
                    $('#show_calculate_wma').html(data)

                }
            );
        }


        function getFormData($form) {
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function (n, i) {
                indexed_array[n['name']] = n['value'];
            });

            return indexed_array;
        }

    </script>
@endsection
