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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id'); // Liên kết với blog
            $table->unsignedBigInteger('user_id')->nullable(); // Liên kết với user (người bình luận)
            $table->unsignedBigInteger('parent_id')->nullable(); // Liên kết với comment gốc
            $table->string('name'); // Tên người bình luận
            $table->string('email'); // Email người bình luận
            $table->text('comment'); // Nội dung bình luận
            $table->timestamps();
    
            // Thiết lập khóa ngoại để liên kết với bảng blogs
            $table->foreign('blog_id')->references('blog_id')->on('blogs')->onDelete('cascade');
            // Thiết lập khóa ngoại cho user_id để liên kết với bảng users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Thiết lập khóa ngoại cho parent_id để liên kết với comment gốc
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
