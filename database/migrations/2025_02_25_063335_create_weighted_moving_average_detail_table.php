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
        Schema::create('weighted_moving_average_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('weighted_moving_average_id');
            $table->string('periode');
            $table->decimal('actual_periode');
            $table->decimal('weight');
            $table->decimal('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighted_moving_average_detail');
    }
};
