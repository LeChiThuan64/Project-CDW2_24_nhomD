<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatboxDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatbox_data', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('customer_name', 255);
            $table->string('customer_phone', 15);
            $table->text('support_issue');
            $table->text('detailed_support_content'); // Add this line
            $table->enum('status', ['Chờ hỗ trợ', 'Đã xong'])->default('Chờ hỗ trợ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chatbox_data');
    }
}