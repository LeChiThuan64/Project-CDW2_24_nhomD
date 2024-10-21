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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('image_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('image_url', 255);
            $table->timestamp('created_at')->useCurrent();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
    
};
