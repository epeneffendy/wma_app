<?php

namespace App\Services;


use App\Models\Products;

class ProductsService
{
    public function get($request = null)
    {
        $data = Products::where(['status' => 1])->get();
        return $data;
    }

    public function findById($code)
    {
        $data = Products::where(['code'=>$code,'status' => 1])->first();
        return $data;
    }

    public function findByCategory($code){
        $data = Products::where(['category_code'=>$code, 'status'=>1])->get();
        return $data;
    }

}
