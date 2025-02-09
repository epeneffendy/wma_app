<?php

namespace App\Services;

use App\Models\WarehouseTransaction;
use Illuminate\Support\Facades\DB;
use stdClass;

class WarehouseTransactionService
{
    public function recalculate($product_code, $transaction_type, $qty)
    {
        $on_hand = $this->lastOnHand($product_code);
        if ($transaction_type == 'in') {
            $result['qty_on_hand'] = $on_hand + $qty;
            $result['qty_in'] = $qty;
            $result['qty_out'] = 0;
        } else {
            $result['qty_on_hand'] = $on_hand - $qty;
            $result['qty_in'] = 0;
            $result['qty_out'] = $qty;
        }
        return $result;
    }

    public function lastOnHand($product_code)
    {
        $last_on_hand = 0;
        $transaction = WarehouseTransaction::where(['product_code' => $product_code])->orderBy('id', 'DESC')->first();
        if (isset($transaction)) {
            $last_on_hand = $transaction->qty_on_hand;
        }
        return $last_on_hand;
    }

    public function findStockProduct($params)
    {

        $data_stock = DB::table('warehouse_transaction')
            ->select(
                'products.code as product_code',
                'products.name as product_name',
                'units.code as unit_code',
                'units.name as unit_name',
                'category.code as category_code',
                'category.name as category_name',
                DB::raw('sum(warehouse_transaction.qty_in) as qty_in'),
                DB::raw('sum(warehouse_transaction.qty_out) as qty_out'),
                DB::raw('((sum(warehouse_transaction.qty_in)) - (sum(warehouse_transaction.qty_out))) as on_hand')
            )
            ->join('products', 'products.code', '=', 'warehouse_transaction.product_code')
            ->join('units', 'units.code', '=', 'warehouse_transaction.unit_code')
            ->join('category', 'category.code', '=', 'warehouse_transaction.category_code');

        if (empty($params['product'])) {
            $data_stock = $data_stock->where(['warehouse_transaction.category_code' => $params['category']]);
        } else {
            $data_stock = $data_stock->where(['warehouse_transaction.category_code' => $params['category'], 'product_code' => $params['product']]);
        }

        $data_stock = $data_stock->where(DB::raw("(STR_TO_DATE(warehouse_transaction.transaction_date,'%Y-%m-%d'))"), '>=', $params['transaction_date_start'])
            ->where(DB::raw("(STR_TO_DATE(warehouse_transaction.transaction_date,'%Y-%m-%d'))"), '<=', $params['transaction_date_end'])
            ->groupBy('products.code', 'units.code', 'units.name', 'category.code', 'category.name')->get();

        return $data_stock;
    }

    public function findTransactionProduct($code)
    {
        $detail_transaction_product = DB::table('warehouse_transaction')
            ->Select(
                'products.code as product_code',
                'products.name as product_name',
                'units.code as unit_code',
                'units.name as unit_name',
                'category.code as category_code',
                'category.name as category_name',
                'warehouse_transaction.qty_in',
                'warehouse_transaction.qty_out',
                'warehouse_transaction.transaction_date',
                'warehouse_transaction.description'
            )
            ->join('products', 'products.code', '=', 'warehouse_transaction.product_code')
            ->join('units', 'units.code', '=', 'warehouse_transaction.unit_code')
            ->join('category', 'category.code', '=', 'warehouse_transaction.category_code')
            ->where(['warehouse_transaction.product_code' => $code])
            ->groupBy('products.code','products.name', 'units.code','units.name', 'category.code', 'category.name',
                'warehouse_transaction.transaction_date', 'warehouse_transaction.description', 'warehouse_transaction.qty_in', 'warehouse_transaction.qty_out')
            ->get();

        return $detail_transaction_product;
    }
}

