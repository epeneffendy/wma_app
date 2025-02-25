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
        Schema::create('weighted_moving_average', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->string('year');
            $table->string('number_of_month');
            $table->string('actual_wma');
            $table->string('weighted_average');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weighted_moving_average');
    }
};
