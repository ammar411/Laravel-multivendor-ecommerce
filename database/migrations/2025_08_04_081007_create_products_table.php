<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    if (!Schema::hasTable('products')) {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
             $table->string('name');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('category_id');
            $table->string('slug')->unique();
            $table->json('images')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_featured')->default(0);
            $table->boolean('in_stock')->default(1);
            $table->boolean('on_sale')->default(0);
            $table->timestamps();

            // Optional: add foreign keys if brands/categories tables exist
            // $table->foreign('brand_id')->references('id')->on('brands');
            // $table->foreign('category_id')->references('id')->on('categories');
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
