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
        Schema::create('warehouse_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('unit_id');
            $table->integer('category_id');
            $table->integer('product_transaction_id');
            $table->string('transaction_type');
            $table->timestamp('transaction_date');
            $table->decimal('qty_in');
            $table->decimal('qty_out');
            $table->decimal('qty_on_hand');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_transaction');
    }
};
