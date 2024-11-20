<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');
            $table->string('name', 50);
            $table->text('description')->nullable();
<<<<<<< HEAD:database/migrations/2023_10_05_000001_create_products_table.php
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->integer('category_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
=======
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
        });        
    }

>>>>>>> main:database/migrations/2024_10_19_013508_create_products_table.php
    public function down()
    {
        Schema::dropIfExists('products');
    }
<<<<<<< HEAD:database/migrations/2023_10_05_000001_create_products_table.php
}
=======
};
>>>>>>> main:database/migrations/2024_10_19_013508_create_products_table.php
