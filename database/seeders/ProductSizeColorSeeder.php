<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_size_color')->insert([
            [
                'product_id' => 1,
                'size_id' => '1',
                'color_id' => '2',
                'quantity' => 10,
                'price' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'size_id' => '3',
                'color_id' => '1',
                'quantity' => 15,
                'price' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'size' => '2',
                'color' => '3',
                'quantity' => 20,
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
