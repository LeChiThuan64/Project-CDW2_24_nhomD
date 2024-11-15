<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product_images')->insert([
            [
                'image_id' => 1,
                'product_id' => 4,
                'image_url' => 'product_0.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 2,
                'product_id' => 4,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 3,
                'product_id' => 4,
                'image_url' => 'product_0-2.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 4,
                'product_id' => 4,
                'image_url' => 'product_0-3.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 5,
                'product_id' => 3,
                'image_url' => 'product_0-3.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 6,
                'product_id' => 2,
                'image_url' => 'product_0.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 7,
                'product_id' => 1,
                'image_url' => 'product_0.jpg',
                'created_at' => '2024-11-04 19:53:52',
            ],
            [
                'image_id' => 8,
                'product_id' => 5,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-12 17:00:17',
            ],
            [
                'image_id' => 9,
                'product_id' => 6,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-12 17:00:45',
            ],
            [
                'image_id' => 10,
                'product_id' => 7,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-12 17:00:45',
            ],
            [
                'image_id' => 11,
                'product_id' => 8,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-12 17:00:45',
            ],
            [
                'image_id' => 12,
                'product_id' => 9,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-12 17:00:45',
            ],
            [
                'image_id' => 13,
                'product_id' => 10,
                'image_url' => 'product_0-1.jpg',
                'created_at' => '2024-11-12 17:00:45',
            ],
            [
                'image_id' => 14,
                'product_id' => 15,
                'image_url' => 'product_0-2.jpg',
                'created_at' => '2024-11-13 08:35:42',
            ],
        ]);

    }
}
