<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('shipping', function (Blueprint $table) {
        $table->id('shipping_id');
        $table->unsignedBigInteger('order_id')->nullable();
        $table->string('shipping_address', 255);
        $table->enum('shipping_method', ['standard', 'express']);
        $table->decimal('shipping_cost', 10, 2);
        $table->timestamp('delivery_date')->nullable();
    });
}

public function down()
{
    Schema::dropIfExists('shipping');
}

};
