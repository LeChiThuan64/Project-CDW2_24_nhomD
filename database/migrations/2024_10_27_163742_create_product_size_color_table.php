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
        Schema::create('product_size_color', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->unsignedBigInteger('color_id');
            $table->integer('quantity')->default(0);
            $table->integer('price')->default(0);
            $table->timestamps();
        
            // Thiết lập khóa ngoại và ràng buộc
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
        
            // Đảm bảo kết hợp (product_id, size_id, color_id) là duy nhất
            $table->unique(['product_id', 'size_id', 'color_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_size_color');
    }
};
