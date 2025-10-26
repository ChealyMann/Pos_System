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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('stock_id'); // Primary key
            $table->unsignedBigInteger('product_id'); // FK to products
            $table->decimal('avg_cost', 10, 2);
            $table->integer('total_qty_in_stock')->default(0);

            // Foreign key constraint will be added later after products table is created
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
