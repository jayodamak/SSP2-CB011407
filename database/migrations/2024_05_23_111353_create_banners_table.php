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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_image');
            $table->string('type');
            $table->string('link')->nullable();
            $table->string('heading')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('button')->nullable();
            $table->string('alt')->nullable();
            $table->integer('sort')->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
