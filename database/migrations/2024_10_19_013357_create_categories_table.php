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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('category_name', 100);
            $table->text('description')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
    
};
