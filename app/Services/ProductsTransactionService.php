<?php

namespace App\Services;


use App\Models\ProductsTransaction;
use App\Models\WarehouseTransaction;
use Illuminate\Support\Facades\DB;

class ProductsTransactionService
{
    public function get($transaction_type)
    {
        $data = ProductsTransaction::where(['transaction_type' => $transaction_type])->get();
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

    public function salesTransaction($month)
    {
        $data = ProductsTransaction::where(DB::raw('DATE_FORMAT(transaction_date,"%Y-%m")'), '=', $month)->sum('total_price');
        return $data;
    }

    public function itemTransaction($month)
    {
        $data = ProductsTransaction::select(DB::raw('count(product_code) as item_transaction'))
            ->where(DB::raw('DATE_FORMAT(transaction_date,"%Y-%m")'), '=', $month)
            ->where(['transaction_type' => 'out'])
            ->groupBy('product_code')->get();
        return $data;
    }

    public function itemPerTransaction($month)
    {
        $data = ProductsTransaction::select([
            DB::raw('count(product_code) as item_transaction'),
            'products.name as product_name',
            'category.name as category_name'
        ])
            ->leftJoin('products', 'products.code', '=', 'products_transaction.product_code')
            ->leftJoin('category', 'category.code', '=', 'products_transaction.category_code')
            ->where(DB::raw('DATE_FORMAT(transaction_date,"%Y-%m")'), '=', $month)
            ->where(['transaction_type' => 'out'])
            ->groupBy(['products.name', 'category.name'])->get();
        return $data;
    }

    public function stockPerItem(){
        $data = WarehouseTransaction::select(['product_code','products.name','qty_in','qty_out', 'category.name'])
            ->leftJoin('products','products.code','=','warehouse_transaction.product_code')
            ->leftJoin('category','category.code','=','products.category_code')
            ->groupBy(['warehouse_transaction.product_code','warehouse_transaction.qty_in','warehouse_transaction.qty_out', 'category.name'])->get();

        $arr_item = [];
        $total_in = $total_out = 0;
        foreach ($data as $item){
            $total_in += $item->qty_in;
            $total_out += $item->qty_out;
            $arr_item[$item->product_code]['product_code'] = $item->product_code;
            $arr_item[$item->product_code]['product_name'] = $item->product->name;
            $arr_item[$item->product_code]['category_name'] = $item->name;
            $arr_item[$item->product_code]['qty_in'] = $total_in;
            $arr_item[$item->product_code]['qty_out'] = $total_out;
        }

        return $arr_item;
    }
}
