<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders_products_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_order_product');
            $table->uuid('id_option');
            $table->decimal('sale_price', 10, 2);
            $table->timestamps();

            $table->foreign('id_order_product')->references('id')->on('orders_products')->onupdate('cascade')->onDelete('cascade');
            $table->foreign('id_option')->references('id')->on('options')->onupdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_products_options');
    }
};
