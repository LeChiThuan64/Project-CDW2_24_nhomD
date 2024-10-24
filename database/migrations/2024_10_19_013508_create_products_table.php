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
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name', 50); // Kiểu NVARCHAR(50)
            $table->text('description')->nullable(); // Có NULL
            $table->string('color', 50)->nullable(); // Kiểu NVARCHAR(50), có thể NULL
            $table->decimal('quantity', 10, 2); // Kiểu DECIMAL(10,2), không NULL
            $table->string('size', 50)->nullable(); // Kiểu NVARCHAR(50), có thể NULL
            $table->integer('price')->default(0); // Kiểu INT, mặc định là 0
            $table->unsignedBigInteger('category_id')->nullable(); // Có thể NULL
            $table->timestamp('created_at')->useCurrent(); // Không NULL, mặc định GETDATE()
            $table->timestamp('updated_at')->nullable(); // Có thể NULL
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
