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
            $table->decimal('price')->after('qty');
            $table->decimal('total_price')->after('price');
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
