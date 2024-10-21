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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
    
};
