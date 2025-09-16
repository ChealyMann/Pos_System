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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Primary key
            $table->string('usercode')->unique();
            $table->string('user_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('email')->unique();
            $table->string('phone_number', 15)->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id'); // foreign key (better to mark unsigned)
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('image')->nullable(); // optional, if not always uploaded
            $table->rememberToken();
            $table->timestamps();

            //Foreign key constraint (if you have a roles table)
            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
