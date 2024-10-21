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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'shipped', 'cancelled']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('shipped_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('orders');
    }
    
};
