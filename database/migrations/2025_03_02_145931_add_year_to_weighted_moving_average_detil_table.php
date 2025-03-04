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
        Schema::table('weighted_moving_average_detail', function (Blueprint $table) {
            $table->string('year')->after('periode');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('weighted_moving_average_detail', function (Blueprint $table) {
            //
        });
    }
};
