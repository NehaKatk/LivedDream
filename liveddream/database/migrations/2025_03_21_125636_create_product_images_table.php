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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('pdf_name')->nullable();
            $table->longText('product_image'); // Use longText for base64 or string for file path
            $table->string('product_color')->nullable();
            $table->string('product_code')->nullable();
            $table->decimal('purchase_cost', 10, 2)->default(0);
            $table->decimal('selling_price', 10, 2)->default(0);
            $table->decimal('discount_price', 10, 2)->default(0);
            $table->integer('stock_available')->default(0);
            $table->integer('sample_status')->default(0);
            $table->timestamps();

            // Foreign key constraint (assuming 'products' table exists)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
