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
    Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');
        $table->unsignedBigInteger('order_id')->nullable();
        $table->enum('payment_method', ['credit card', 'e-wallet', 'bank transfer']);
        $table->enum('payment_status', ['success', 'failed']);
        $table->timestamp('payment_date')->useCurrent();
    });
}

public function down()
{
    Schema::dropIfExists('payments');
}

};
