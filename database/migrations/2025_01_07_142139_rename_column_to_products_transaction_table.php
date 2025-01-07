<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products_transaction', function (Blueprint $table) {
            $table->renameColumn('product_id', 'product_code');
            $table->renameColumn('unit_id', 'unit_code');
            $table->renameColumn('category_id', 'category_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products_transaction', function (Blueprint $table) {
            //
        });
    }
};
