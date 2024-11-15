<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ShoppingCartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('shopping_cart')->insert([
            [
                'cart_id' => 1,
                'user_id' => 1,
                'created_at' => '2024-11-04 19:58:15',
            ],
            [
                'cart_id' => 2,
                'user_id' => 2,
                'created_at' => '2024-11-04 19:58:15',
            ],
            [
                'cart_id' => 3,
                'user_id' => 3,
                'created_at' => '2024-11-04 19:58:15',
            ],
            [
                'cart_id' => 4,
                'user_id' => 4,
                'created_at' => '2024-11-04 19:58:15',
            ],
        ]);
    }
}
