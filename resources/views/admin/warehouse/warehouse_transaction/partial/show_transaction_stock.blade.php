<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title m-0 me-2">Warehouse Transaction Stock</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                        <tr>
                            <td>Category</td>
                            <td>Product</td>
                            <td>Unit</td>
                            <td>Qty In</td>
                            <td>Qty Out</td>
                            <td>On Hand</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{$item['category_name']}}</td>
                                <td><a class="btn" id="detail_transaction_product" data-id="{{$item['product_code']}}" style="color: #804be0">{{$item['product_code']  .' - '.  $item['product_name']}}</a> </td>
                                <td>{{$item['unit_code']}}</td>
                                <td>{{$item['qty_in']}}</td>
                                <td>{{$item['qty_out']}}</td>
                                <td>{{$item['on_hand']}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


