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
        Schema::create('stock_ins', function (Blueprint $table) {
            $table->id('stock_in_id'); // Primary key

            // Foreign keys
            $table->unsignedBigInteger('purchase_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('created_by'); // user_id of the staff who created this record

            $table->integer('qty');
            $table->decimal('cost_per_item', 10, 2);
            $table->date('expire_date')->nullable(); // in case some products don’t expire
            $table->integer('qty_in_stock');

            // If you want custom date for stock-in
            $table->timestamp('stock_in_date')->useCurrent();

            // Laravel default timestamps (created_at, updated_at)
            $table->timestamps();

            // Foreign key constraints will be added later after all tables are created
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ins');
    }
};
