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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->date('check_in')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('pickup_location')->nullable();
            $table->date('check_out')->nullable();
            $table->time('return_time')->nullable();
            $table->string('return_location')->nullable();
            $table->integer('trip_duration')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->double('extras_total', 10, 2)->nullable();
            $table->double('sub_total', 10, 2)->nullable();
            $table->double('grand_total', 10, 2)->nullable();
            $table->string('driver_requesting', 10)->nullable();
            $table->string('driver_first_lang')->nullable();
            $table->string('driver_second_lang')->nullable();
            $table->string('instructor_requesting', 10)->nullable();
            $table->string('instructor_first_lang')->nullable();
            $table->string('instructor_second_lang')->nullable();
            $table->string('guide_requesting', 10)->nullable();
            $table->string('guide_first_lang')->nullable();
            $table->string('guide_second_lang')->nullable();
            $table->string('local_license', 10)->nullable();
            $table->integer('local_license_qty')->nullable();
            $table->string('instructor_additional_session', 10)->nullable();
            $table->integer('instructor_additional_session_qty')->nullable();
            $table->string('baby_seat', 10)->nullable();
            $table->integer('baby_seat_qty')->nullable();
            $table->string('bluetooth_speakers', 10)->nullable();
            $table->integer('bluetooth_speakers_qty')->nullable();
            $table->string('tuktuk_with_seatbelts', 10)->nullable();
            $table->integer('tuktuk_with_seatbelts_qty')->nullable();
            $table->string('cooler', 10)->nullable();
            $table->integer('cooler_qty')->nullable();
            $table->unsignedBigInteger('passenger_id')->nullable();
            $table->string('payment_status')->nullable()->default('Pending');
            $table->string('booking_status')->nullable()->default('Pending');
            $table->string('trip_status')->nullable()->default('Pending');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')->references('id')->on('applicants_for_driver')->onDelete('cascade');
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->foreign('instructor_id')->references('id')->on('applicants_for_instructor')->onDelete('cascade');
            $table->unsignedBigInteger('mechanic_id')->nullable();
            $table->foreign('mechanic_id')->references('id')->on('applicants_for_mechanic')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};