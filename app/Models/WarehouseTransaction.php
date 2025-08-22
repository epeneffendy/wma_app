<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseTransaction extends Model
{
    use HasFactory;
    protected $table = 'warehouse_transaction';

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Products::class, 'product_code','code');
    }
}
