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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_customer');
            $table->unsignedBigInteger('id_user');
            $table->string('state');
            $table->string('payment_method');
            $table->integer('order_number');
            $table->integer('voluntary_tip_percentage')->default(0);
            $table->integer('voluntary_tip_value')->default(0);
            $table->integer('tax');
            $table->timestamps();

            $table->foreign('id_customer')->references('id')->on('customers');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
