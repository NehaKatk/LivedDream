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
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('product_code')->unique();
            $table->integer('gst');
            $table->integer('warranty_duration')->nullable();; // Stores duration as a number (e.g., 2)
            $table->enum('warranty_type', ['days', 'months', 'years']); // Restricts values to specific options
            $table->unsignedBigInteger('adhesive_id');
            $table->decimal('labor_charge', 10, 2)->default(0);
            $table->date('estimate_delivery_duration')->nullable();
            $table->enum('estimate_delivery_type', ['days', 'months']); // Restricts values to specific options

            $table->string('image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Foreign Keys (Assuming these tables exist)
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('adhesive_id')->references('id')->on('adhesives')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
