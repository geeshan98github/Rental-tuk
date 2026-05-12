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
        Schema::create('passenger_users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->nullable();
            $table->string('profile_image')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('emergency_number')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contry_of_residence')->nullable();
            $table->char('is_email_verified')->default('N')->comment('Y = Yes, N = No');
            $table->string('verification_code')->nullable();
            $table->string('passport_image')->nullable();
            $table->string('license_image')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passenger_users');
    }
};
