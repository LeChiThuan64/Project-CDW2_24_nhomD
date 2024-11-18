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
                'id' => 1,
                'product_id' => 1,
                'size_id' => 1,
                'color_id' => 2,
                'quantity' => 10,
                'price' => 1000,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-04 12:50:34',
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 15,
                'price' => 1000,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-04 12:50:34',
            ],
            [
                'id' => 4,
                'product_id' => 4,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 12,
                'price' => 21211,
                'created_at' => '2024-11-04 12:53:52',
                'updated_at' => '2024-11-09 15:10:47',
            ],
            [
                'id' => 5,
                'product_id' => 4,
                'size_id' => 5,
                'color_id' => 2,
                'quantity' => 17,
                'price' => 1000,
                'created_at' => '2024-11-04 12:53:52',
                'updated_at' => '2024-11-06 22:07:10',
            ],
            [
                'id' => 6,
                'product_id' => 3,
                'size_id' => 2,
                'color_id' => 3,
                'quantity' => 19,
                'price' => 10000,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-07 01:00:17',
            ],
            [
                'id' => 8,
                'product_id' => 4,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 200000000,
                'created_at' => '2024-11-11 22:18:58',
                'updated_at' => null,
            ],
            [
                'id' => 9,
                'product_id' => 5,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 20000,
                'created_at' => '2024-10-23 22:19:12',
                'updated_at' => null,
            ],
            [
                'id' => 10,
                'product_id' => 6,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 20000,
                'created_at' => '2024-10-03 22:19:05',
                'updated_at' => null,
            ],
            [
                'id' => 11,
                'product_id' => 7,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 20000,
                'created_at' => '2024-11-05 22:19:28',
                'updated_at' => null,
            ],
            [
                'id' => 12,
                'product_id' => 8,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 20000,
                'created_at' => '2024-10-06 22:19:22',
                'updated_at' => null,
            ],
            [
                'id' => 13,
                'product_id' => 9,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 20000,
                'created_at' => '2024-11-01 22:19:34',
                'updated_at' => null,
            ],
            [
                'id' => 14,
                'product_id' => 10,
                'size_id' => 3,
                'color_id' => 1,
                'quantity' => 200,
                'price' => 20000,
                'created_at' => '2024-10-24 22:19:39',
                'updated_at' => null,
            ],
            [
                'id' => 17,
                'product_id' => 9,
                'size_id' => 2,
                'color_id' => 1,
                'quantity' => 123,
                'price' => 12,
                'created_at' => '2024-11-13 01:34:01',
                'updated_at' => '2024-11-13 01:34:01',
            ],
        ]);
    }
}
