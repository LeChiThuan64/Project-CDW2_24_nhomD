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
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->id('cart_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shopping_cart');
    }
    
};
