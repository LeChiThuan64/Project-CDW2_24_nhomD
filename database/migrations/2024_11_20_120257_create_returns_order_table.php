<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnsOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returns_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Thêm cột user_id
            $table->unsignedBigInteger('orders_id');
            $table->unsignedBigInteger('product_id');
            $table->string('status_product');
            $table->string('return_reason');
            $table->text('detailed_description')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->unsignedBigInteger('banking_id');
            $table->string('phone');
            $table->string('status')->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('banking_id')->references('id')->on('bank_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returns_order');
    }
}