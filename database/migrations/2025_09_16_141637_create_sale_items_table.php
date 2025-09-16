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
        Schema::create('sale_items', function (Blueprint $table) {
            $table->id('sale_item_id'); // Primary key

            // Foreign keys
            $table->unsignedBigInteger('sale_id');    // FK to sales
            $table->unsignedBigInteger('product_id'); // FK to products

            $table->integer('qty');
            $table->decimal('price_per_item', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('sale_id')
                ->references('sale_id')->on('sales')
                ->onDelete('cascade');

            $table->foreign('product_id')
                ->references('product_id')->on('products')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_items');
    }
};
