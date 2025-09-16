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
            $table->id('product_id'); // Primary key
            $table->string('barcode')->unique();
            $table->string('product_name')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);

            // Foreign keys
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('created_by');

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('image')->nullable(); // not unique, allow multiple products with same image
            $table->timestamps();

            // Foreign key constraints

            $table->foreign('created_by')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('category_id')->on('categories')
                ->onDelete('cascade');

            $table->foreign('country_id')
                ->references('country_id')->on('countries')
                ->onDelete('cascade');
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
