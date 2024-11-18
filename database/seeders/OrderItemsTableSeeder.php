<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'product_id' => 4,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 4,
                'price' => 25.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 1,
                'price' => 15.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 4,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 1,
                'price' => 30.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 5,
                'price' => 20.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'product_id' => 4,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 8,
                'price' => 35.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 10,
                'price' => 40.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}