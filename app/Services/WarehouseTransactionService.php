<?php

namespace App\Services;

use App\Models\WarehouseTransaction;
use stdClass;

class WarehouseTransactionService
{
    public function recalculate($product_code, $transaction_type, $qty)
    {
        $on_hand = $this->lastOnHand($product_code);
        if ($transaction_type == 'in'){
            $result['qty_on_hand'] = $on_hand + $qty;
            $result['qty_in'] = $qty;
            $result['qty_out'] = 0;
        }else{
            $result['qty_on_hand'] = $on_hand - $qty;
            $result['qty_in'] = 0;
            $result['qty_out'] = $qty;
        }
        return $result;
    }

    public function lastOnHand($product_code)
    {
        $last_on_hand = 0;
        $transaction = WarehouseTransaction::where(['product_code'=>$product_code])->orderBy('id','DESC')->first();
        if (isset($transaction)){
            $last_on_hand = $transaction->qty_on_hand;
        }
        return $last_on_hand;
    }

}
