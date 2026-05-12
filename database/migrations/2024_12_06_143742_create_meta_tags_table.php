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
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->id();
            $table->string('page_name', 255);
            $table->string('page_title', 255);
            $table->longText('description');
            $table->longText('keywords');
            $table->string('og_title', 255);
            $table->string('og_type', 255);
            $table->string('og_url', 255);
            $table->string('og_image', 255);
            $table->string('og_sitename', 255);
            $table->longText('og_description');
            $table->string('og_email', 255);
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
        Schema::dropIfExists('meta_tags');
    }
};
