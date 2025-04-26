<?php

namespace App\Services;


use App\Models\ProductsTransaction;
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
}
