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
                        <label class="col-sm-2 col-form-label" for="periode">Periode</label>
                        <div class="col-sm-6">
                            <select class="form-select" id="periode" name="periode" aria-label="Periode">
                                <option value="0">-- Select Periode --</option>
                                @foreach($periode as $ind => $item)
                                    <option value="{{$ind}}"> {{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="year">Year</label>
                        <div class="col-sm-6">
                            <select class="form-select" id="year" name="year" aria-label="Year">
                                @foreach($year as $ind => $item)
                                    <option
                                        value="{{$item}}" <?= ($item == date('Y') ? 'selected' : '') ?>> {{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="total_month">Total Month</label>
                        <div class="col-sm-2">
                            <input class="form-control" type="number" id="total_month" name="total_month"/>
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
        });

        function validationCalculateWma() {
            let success = true;
            let message = 'validation success';

            let periode = $('#periode').val();
            let total_month = $('#total_month').val();
            let year = $('#year').val();

            if (periode == 0) {
                success = false;
                message = 'Periode cannot be empty!'
            }

            if (total_month == '') {
                success = false;
                message = 'Total Month cannot be empty!'
            }

            if (total_month != '' && total_month >= 6) {
                success = false;
                message = 'Total Months should not exceed 5!'
            }

            if (success) {
                let params = {
                    'periode': periode,
                    'total_month': total_month,
                    'year': year,
                }
                calculateWma(params)
            } else {
                swal('warning', message, 'warning');
            }
        }

        function calculateWma(params) {
            $.post(
                base_prefix + '/weighted_moving_average/calculate_wma',
                {
                    "_token": "{{ csrf_token() }}",
                    'periode': params.periode,
                    'total_month': params.total_month,
                    'year': params.year
                },
                function (data) {
                    $('#show_calculate_wma').html('');
                    $('#show_calculate_wma').html(data)

                }
            );
        }

    </script>
@endsection
