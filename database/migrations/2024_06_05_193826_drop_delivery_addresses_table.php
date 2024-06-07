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
        Schema::dropIfExists('delivery_addresses');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->id();
            // add other columns as necessary
            $table->timestamps();
        });
    }
};
