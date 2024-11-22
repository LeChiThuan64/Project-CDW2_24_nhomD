<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('cart_items')->insert([
            [
                'cart_item_id' => 9,
                'cart_id' => 1,
                'product_id' => 4,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 4,
                'created_at' => '2024-11-03 22:39:09',
                'updated_at' => '2024-11-09 15:19:53',
            ],
            [
                'cart_item_id' => 10,
                'cart_id' => 1,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 1,
                'created_at' => '2024-11-06 17:19:41',
                'updated_at' => '2024-11-07 01:13:55',
            ],
            [
                'cart_item_id' => 13,
                'cart_id' => 1,
                'product_id' => 4,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 1,
                'created_at' => '2024-11-15 14:34:34',
                'updated_at' => '2024-11-15 14:34:34',
            ],
            [
                'cart_item_id' => 14,
                'cart_id' => 2,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 5,
                'created_at' => '2024-11-06 22:39:04',
                'updated_at' => null,
            ],
            [
                'cart_item_id' => 15,
                'cart_id' => 3,
                'product_id' => 4,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 8,
                'created_at' => '2024-11-04 22:39:13',
                'updated_at' => null,
            ],
            [
                'cart_item_id' => 16,
                'cart_id' => 4,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 10,
                'created_at' => '2024-11-02 22:39:21',
                'updated_at' => null,
            ],
        ]);
    }
}
