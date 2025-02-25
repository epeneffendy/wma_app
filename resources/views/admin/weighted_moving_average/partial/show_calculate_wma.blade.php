<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0 me-2">Calculate Weighted Moving Average</h5>
            </div>

            <div class="card-body">
                @foreach($actual as $ind => $item)
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label class="col-sm-12 col-form-label" for="total_month">Year</label>
                            <input class="form-control" type="number" value="{{$item['year']}}" id="year"
                                   name="year_{{$ind}}" readonly/>
                        </div>

                        <div class="col-sm-3">
                            <label class="col-sm-12 col-form-label" for="total_month">Periode</label>
                            <input class="form-control" type="text" value="{{$item['periode']}}" id="periode"
                                   name="periode_{{$ind}}" readonly/>
                        </div>

                        <div class="col-sm-3">
                            <label class="col-sm-12 col-form-label" for="total_month">Actual</label>
                            <input class="form-control" type="number" value="{{$item['actual']}}" id="actual"
                                   name="actual_{{$ind}}"/>
                        </div>

                        <div class="col-sm-3">
                            <label class="col-sm-12 col-form-label" for="total_month">Weight</label>
                            <input class="form-control" type="number" id="weight" name="weight_{{$ind}}"/>
                        </div>
                    </div>
                @endforeach
                <div class="mt-4">
                    <button type="button" class="btn btn-primary me-2" id="fetch_wma"><span
                            class="tf-icons mdi mdi-magnify me-1"></span>Proses WMA
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


