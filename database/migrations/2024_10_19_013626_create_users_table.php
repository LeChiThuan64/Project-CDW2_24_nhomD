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
        // Nếu bảng chưa tồn tại, tạo bảng 'users'
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id('user_id');
                $table->string('name', 100);
                $table->string('email', 100)->unique();
                $table->string('password', 255);
                $table->string('phone', 15)->nullable();
                $table->string('address', 255)->nullable();
                $table->integer('role')->default(1); // Đặt mặc định là 1
                $table->timestamps(); // Tự động tạo 'created_at' và 'updated_at'
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Xóa bảng nếu cần rollback
        Schema::dropIfExists('users');
    }
};
