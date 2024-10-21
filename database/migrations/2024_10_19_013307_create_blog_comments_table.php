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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->unsignedBigInteger('blog_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('comment');
            $table->timestamp('created_at')->useCurrent();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('blog_comments');
    }
    
};
