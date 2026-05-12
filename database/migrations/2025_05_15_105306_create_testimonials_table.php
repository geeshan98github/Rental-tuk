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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 190);
            $table->string('designation', 190)->nullable();
            $table->string('company_name', 255)->nullable();
            $table->string('heading_tag', 255)->nullable();
            $table->Text('comment')->nullable();
            $table->string('profile_image', 255)->nullable();
            $table->tinyInteger('order');
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
        Schema::dropIfExists('testimonials');
    }
};
