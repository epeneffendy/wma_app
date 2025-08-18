<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0 me-2">Calculate Weighted Moving Average</h5>
            </div>

            <div class="card-body">
{{--                <input class="form-control" type="hidden" value="{{$count}}" id="count"--}}
{{--                       name="count" readonly/>--}}
                <form id="show_data_actual">
                    @foreach($actual as $ind => $item)
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="col-sm-12 col-form-label" for="date">Date</label>
                                <input class="form-control" type="text" value="{{$item['date']}}" id="date"
                                       name="date_{{$ind}}" readonly/>
                            </div>

                            <div class="col-sm-3">
                                <label class="col-sm-12 col-form-label" for="total_month">Actual</label>
                                <input class="form-control" type="number" value="{{$item['actual']}}" id="actual"
                                       name="actual_{{$ind}}" readonly/>
                            </div>

                            <div class="col-sm-3">
                                <label class="col-sm-12 col-form-label" for="total_month">Weight</label>
                                <input class="form-control" type="text" id="weight" name="weight_{{$ind}}" value="{{$item['weight']}}" id="weight" readonly/>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4">
                        <button type="button" class="btn btn-primary me-2" id="count_wma"><span
                                class="tf-icons mdi mdi-magnify me-1"></span>Proses WMA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


