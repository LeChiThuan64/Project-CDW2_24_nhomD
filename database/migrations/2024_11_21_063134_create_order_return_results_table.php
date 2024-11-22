<?php
// database/migrations/xxxx_xx_xx_create_order_return_results_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderReturnResultsTable extends Migration
{
    public function up()
    {
        Schema::create('order_return_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('returns_order_id');
            $table->unsignedBigInteger('order_id'); // Thêm cột order_id
            $table->unsignedBigInteger('product_id');
            $table->text('return_status');
            $table->text('reason')->nullable();
            $table->timestamps();

            $table->foreign('returns_order_id')->references('id')->on('returns_order')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade'); // Thêm khóa ngoại cho order_id
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade'); // Thêm khóa ngoại cho product_id
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_return_results');
    }
}