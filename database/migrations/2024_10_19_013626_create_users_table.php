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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
            $table->string('phone', 15)->nullable();
            $table->string('role', 20)->default('1');
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Cột giới tính
            $table->date('dob')->nullable(); // Cột ngày sinh
            $table->boolean('is_active')->default(1); // Cột hoạt động
            $table->string('profile_image', 255)->nullable(); // Cột ảnh đại diện, cho phép null
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
