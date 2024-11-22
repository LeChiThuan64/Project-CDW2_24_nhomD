<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('wishlists')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'product_id' => 4,
                'created_at' => '2024-11-06 09:17:09',
                'updated_at' => '2024-11-06 09:17:09',
            ],
            [
                'id' => 7,
                'user_id' => 2,
                'product_id' => 1,
                'created_at' => '2024-11-15 08:20:34',
                'updated_at' => '2024-11-15 08:20:34',
            ],
            [
                'id' => 8,
                'user_id' => 2,
                'product_id' => 9,
                'created_at' => '2024-11-15 08:57:07',
                'updated_at' => '2024-11-15 08:57:07',
            ],
            [
                'id' => 9,
                'user_id' => 2,
                'product_id' => 6,
                'created_at' => '2024-11-15 08:57:26',
                'updated_at' => '2024-11-15 08:57:26',
            ],
            [
                'id' => 10,
                'user_id' => 2,
                'product_id' => 3,
                'created_at' => '2024-11-15 08:57:33',
                'updated_at' => '2024-11-15 08:57:33',
            ],
            [
                'id' => 11,
                'user_id' => 2,
                'product_id' => 7,
                'created_at' => '2024-11-15 08:57:42',
                'updated_at' => '2024-11-15 08:57:42',
            ],
            [
                'id' => 12,
                'user_id' => 2,
                'product_id' => 8,
                'created_at' => '2024-11-15 08:57:55',
                'updated_at' => '2024-11-15 08:57:55',
            ],
            [
                'id' => 13,
                'user_id' => 2,
                'product_id' => 10,
                'created_at' => '2024-11-15 08:58:00',
                'updated_at' => '2024-11-15 08:58:00',
            ],
            [
                'id' => 14,
                'user_id' => 2,
                'product_id' => 2,
                'created_at' => '2024-11-15 14:34:01',
                'updated_at' => '2024-11-15 14:34:01',
            ],
        ]);
    }
}
