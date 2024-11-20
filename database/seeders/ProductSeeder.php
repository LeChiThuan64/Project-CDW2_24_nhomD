<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('products')->insert([
            [
                'product_id' => 1,
                'name' => 'Men\'s Classic White T-Shirt',
                'description' => 'A versatile white t-shirt made from 100% cotton. Ideal for casual wear or layering with other outfits.',
                'category_id' => 1,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-04 12:50:34',
            ],
            [
                'product_id' => 2,
                'name' => 'Women\'s Slim Fit Jeans',
                'description' => 'Stylish slim fit jeans with a comfortable stretch, perfect for everyday wear or dressing up for a night out.',
                'category_id' => 2,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-04 12:50:34',
            ],
            [
                'product_id' => 3,
                'name' => 'Men\'s Navy Blue Hoodie',
                'description' => 'A cozy hoodie made from soft fleece with a drawstring hood, ideal for keeping warm during colder months.',
                'category_id' => 3,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-04 12:50:34',
            ],
            [
                'product_id' => 4,
                'name' => 'Women\'s Floral Summer Dress',
                'description' => 'A lightweight summer dress with a vibrant floral pattern, perfect for outdoor events and casual outings.',
                'category_id' => 1,
                'created_at' => '2024-11-08 17:04:36',
                'updated_at' => null,
            ],
            [
                'product_id' => 5,
                'name' => 'Men\'s Leather Jacket',
                'description' => 'Premium leather jacket with a sleek design, ideal for a night out or adding an edgy touch to your wardrobe.',
                'category_id' => 2,
                'created_at' => '2024-11-04 12:50:34',
                'updated_at' => '2024-11-04 12:50:34',
            ],
            [
                'product_id' => 6,
                'name' => 'Women\'s High-Waisted Skirt',
                'description' => 'A flattering high-waisted skirt made from soft cotton, perfect for both casual and formal wear.',
                'category_id' => 3,
                'created_at' => '2024-11-14 17:04:48',
                'updated_at' => null,
            ],
            [
                'product_id' => 7,
                'name' => 'Men\'s Athletic Shorts',
                'description' => 'Comfortable and breathable athletic shorts, designed for sports and outdoor activities.',
                'category_id' => 1,
                'created_at' => '2024-11-03 17:05:07',
                'updated_at' => null,
            ],
            [
                'product_id' => 8,
                'name' => 'Women\'s Trench Coat',
                'description' => 'A stylish and classic trench coat, perfect for layering in cool weather, with a tailored fit and belted waist.',
                'category_id' => 2,
                'created_at' => '2024-11-21 17:04:54',
                'updated_at' => null,
            ],
            [
                'product_id' => 9,
                'name' => 'Men\'s Casual Blazer',
                'description' => 'A versatile blazer that can be dressed up or down, perfect for a business casual or smart-casual look.',
                'category_id' => 3,
                'created_at' => '2024-11-05 17:05:03',
                'updated_at' => null,
            ],
            [
                'product_id' => 10,
                'name' => 'Women\'s Knit Sweater',
                'description' => 'A cozy knit sweater made with soft wool, ideal for layering or wearing on its own during chilly days.',
                'category_id' => 1,
                'created_at' => '2024-11-07 17:04:58',
                'updated_at' => null,
            ],
        ]);
    }
}
