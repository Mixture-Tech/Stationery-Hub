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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('id_order_detail');
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_product');
            $table->unsignedBigInteger('id_district');
            $table->unsignedBigInteger('id_province');
            $table->unsignedBigInteger('id_area');
            $table->integer('quantity');
            $table->decimal('total_product', 10, 2);
            $table->boolean('hide')->default(false);
            $table->timestamps();

            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
            $table->foreign('id_product')->references('id_product')->on('products')->onDelete('cascade');
            $table->foreign('id_district')->references('id_district')->on('districts')->onDelete('cascade');
            $table->foreign('id_province')->references('id_province')->on('provinces')->onDelete('cascade');
            $table->foreign('id_area')->references('id_area')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
