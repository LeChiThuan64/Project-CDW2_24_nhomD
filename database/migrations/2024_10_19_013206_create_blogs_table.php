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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id('blog_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title', 100);
            $table->text('content')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->string('image_url', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
    
};
