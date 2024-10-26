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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id'); // Primary key
            $table->foreignId('order_id')->constrained('orders'); // Foreign key linking to orders
            $table->string('product_name'); // Product name
            $table->integer('quantity'); // Quantity
            $table->decimal('price', 10, 2); // Price  $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
