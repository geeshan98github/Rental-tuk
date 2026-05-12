<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehical_details', function (Blueprint $table) {
            $table->id();
            $table->string('vehical_type');
            $table->string('vehical_number');
            $table->string('rate_per_day');
            $table->string('deposit_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehical_details');
    }
};
