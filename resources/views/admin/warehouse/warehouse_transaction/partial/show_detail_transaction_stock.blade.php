<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0 me-2">Warehouse Details Transaction</h5>
            </div>

            <div class="card-body">
                <div style="text-align: right; margin-bottom: 1em">
                    <button class="btn btn-sm btn-warning" id="back_warehouse"><< Back To Warehouse Stock</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                        <tr>
                            <td>Category</td>
                            <td>Product</td>
                            <td>Unit</td>
                            <td>Category</td>
                            <td>Qty In</td>
                            <td>Qty Out</td>
                            <td>Transaction Date</td>
                            <td>Description</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item['category_name']}}</td>
                                <td>{{$item['product_code'] .' - '. $item['product_name']}}</td>
                                <td>{{$item['unit_code']}}</td>
                                <td>{{$item['category_name']}}</td>
                                <td>{{$item['qty_in']}}</td>
                                <td>{{$item['qty_out']}}</td>
                                <td>{{$item['transaction_date']}}</td>
                                <td>{{$item['description']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


