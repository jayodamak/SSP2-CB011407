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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('product_name');
            $table->string('url');
            $table->string('product_code');
            $table->string('product_color')->nullable();
            $table->string('family_color')->nullable();
            $table->float('product_price');
            // $table->float('product_weight')->nullable();
            $table->float('product_discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->float('final_price')->nullable();
            $table->string('product_image')->nullable();
            $table->text('description')->nullable();
            $table->text('search_keywords')->nullable();
            // $table->string('fabric')->nullable();
            // $table->string('occassion')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->tinyInteger('status');
            $table->enum('is_featured',['No','Yes']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
