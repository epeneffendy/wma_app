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
        Schema::table('warehouse_transaction', function (Blueprint $table) {
            $table->string('product_code')->change();
            $table->string('unit_code')->change();
            $table->string('category_code')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warehouse_transaction', function (Blueprint $table) {
            //
        });
    }
};
