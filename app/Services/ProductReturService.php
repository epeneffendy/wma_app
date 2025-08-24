<?php
namespace App\Services;


use App\Models\ProductRetur;
use Carbon\Carbon;

class ProductReturService{

    public function get($request = null)
    {
        $data = ProductRetur::get();
        return $data;
    }

    public function insert($payload, $product){

        $payload['category_code'] = $product->category_code;
        $payload['unit_code'] = $product->unit_code;
        $payload['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
        $payload['updated_at'] = Carbon::now()->format('Y-m-d H:i:s');;
        unset($payload['transaction_date']);
        unset($payload['_token']);
        unset($payload['editable']);

        $insert = ProductRetur::insert($payload);
        return $insert;

    }
}
