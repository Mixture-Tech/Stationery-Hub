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
            $table->id('id_order');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_district');
            $table->unsignedBigInteger('id_province');
            $table->unsignedBigInteger('id_area');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_methods');
            $table->string('phone')->nullable(); 
            $table->string('address')->nullable();
            $table->boolean('hide')->default(false);
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
};
