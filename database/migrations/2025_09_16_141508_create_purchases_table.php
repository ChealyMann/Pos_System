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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id('purchase_id'); // Primary key

            // Foreign keys
            $table->unsignedBigInteger('supplier_id'); // FK to suppliers
            $table->unsignedBigInteger('created_by');  // FK to users

            $table->date('purchase_date');
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['cash', 'aba', 'acleda', 'other_bank'])->default('cash');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->text('note')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('supplier_id')
                ->references('supplier_id')->on('suppliers')
                ->onDelete('cascade');

            $table->foreign('created_by')
                ->references('user_id')->on('users')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
