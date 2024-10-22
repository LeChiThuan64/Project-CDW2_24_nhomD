<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Áo thun nam tay ngắn',
                'description' => 'Áo thun tay ngắn màu đen, phong cách đơn giản và dễ mặc.',
                'price' => 149.99,
                'quantity' => 100,
                'category_id' => 1,
            ],
            [
                'name' => 'Áo thun nữ tay dài',
                'description' => 'Áo thun nữ tay dài, chất liệu mềm mại, kiểu dáng hiện đại.',
                'price' => 179.99,
                'quantity' => 75,
                'category_id' => 2,
            ],
            [
                'name' => 'Áo thun thể thao',
                'description' => 'Áo thun thể thao thấm hút mồ hôi, thích hợp cho vận động mạnh.',
                'price' => 249.99,
                'quantity' => 120,
                'category_id' => 3,
            ],
        ]);
    }
}