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
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id'); // Primary key

            // Foreign key to users (staff who made the sale)
            $table->unsignedBigInteger('sale_by');

            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['cash', 'aba', 'acleda', 'other_bank'])->default('cash');
            $table->enum('status', ['paid', 'unpaid'])->default('paid');
            $table->date('sale_date');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('sale_by')
                ->references('user_id')->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
