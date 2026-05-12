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
        Schema::create('applicants_for_driver', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number',20)->nullable();
            $table->string('address')->nullable();
            $table->string('license_number')->nullable();
            $table->integer('year_of_experience')->nullable();
            $table->string('vehical_reg_number')->nullable();
            $table->string('spoken_languages')->nullable();
            $table->string('license_image')->nullable();
            $table->string('police_report')->nullable();
            $table->string('approve_status',20)->default('pending');
            $table->char('status', 1)->default('Y');
            $table->tinyInteger('is_delete')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants_for_driver');
    }
};
