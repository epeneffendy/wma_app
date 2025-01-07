<?php

namespace App\Services;


use App\Models\ProductsTransaction;

class ProductsTransactionService
{
    public function get($transaction_type)
    {
        $data = ProductsTransaction::where(['transaction_type'=>$transaction_type])->get();
        return $data;
    }

    public function findById($id)
    {
        $data = ProductsTransaction::where(['id' => $id])->first();
        return $data;
    }

    public function insert($payload)
    {
        $payload['transaction_date'] = date('Y-m-d H:i:s');
        $payload['created_at'] = date('Y-m-d H:i:s');
        $payload['updated_at'] = date('Y-m-d H:i:s');
        $data = ProductsTransaction::insertGetId($payload);
        return $data;
    }
}
