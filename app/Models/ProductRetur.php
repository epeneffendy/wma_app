<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRetur extends Model
{
    use HasFactory;
    protected $table = 'product_retur';

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Products::class, 'product_code','code');
    }

    public function category(): BelongsTo
    {
        return $this->BelongsTo(Category::class, 'category_code','code');
    }

    public function unit(): BelongsTo
    {
        return $this->BelongsTo(Units::class, 'unit_code','code');
    }
}
