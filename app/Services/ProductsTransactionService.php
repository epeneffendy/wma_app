<?php
namespace App\Services;



use App\Models\ProductsTransaction;

class ProductsTransactionService{
    public function get($request = null){
        $data = ProductsTransaction::get();
        return $data;
    }

    public function findById($id){
        $data = ProductsTransaction::where(['id'=>$id])->first();
        return $data;
    }
}
