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
        Schema::create('combos_products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_combo');
            $table->uuid('id_product');
            $table->integer('quantity')->default(1);
            $table->timestamps();

            $table->foreign('id_combo')->references('id')->on('combos')->onDelete('cascade');
            $table->foreign('id_product')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos_products');
    }
};
