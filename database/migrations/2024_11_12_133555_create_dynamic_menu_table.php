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
        Schema::create('dynamic_menu', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('title');
            $table->tinyInteger('page_id');
            $table->string('url');
            $table->tinyInteger('parent_id');
            $table->char('is_parent',1);
            $table->char('show_menu',1);
            $table->tinyInteger('parent_order')->nullable();
            $table->tinyInteger('child_order');
            $table->double('fOrder',8,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dynamic_menu');
    }
};
