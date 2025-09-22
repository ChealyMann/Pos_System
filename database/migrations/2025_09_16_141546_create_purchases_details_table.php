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
        Schema::create('purchases_details', function (Blueprint $table) {
            $table->id('purchase_detail_id'); // Primary key

            // Foreign keys
            $table->unsignedBigInteger('purchase_id'); // FK to purchases
            $table->unsignedBigInteger('product_id');  // FK to products

            $table->integer('qty');
            $table->decimal('unit_cost', 10, 2);
            $table->date('expiry_date')->nullable(); // in case some products don’t expire
            $table->decimal('total_cost', 10, 2);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('purchase_id')
                ->references('purchase_id')->on('purchases')
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
        Schema::dropIfExists('purchases_details');
    }
};
