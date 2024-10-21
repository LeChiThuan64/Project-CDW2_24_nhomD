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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id('review_id');
        $table->unsignedBigInteger('user_id')->nullable();
        $table->unsignedBigInteger('product_id')->nullable();
        $table->integer('rating');
        $table->text('comment')->nullable();
        $table->timestamp('created_at')->useCurrent();
    });
}

public function down()
{
    Schema::dropIfExists('reviews');
}

};
