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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('id_category');
            $table->string('name_category')->unique();
            $table->string('link')->nullable();
            $table->unsignedBigInteger('id_parent');
            $table->boolean('hide')->default(false);
            $table->timestamps();

            $table->foreign('id_parent')->references('id_parent')->on('category_parents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
