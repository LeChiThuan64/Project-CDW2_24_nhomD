<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('reviews')->insert([
            [
                'id' => 5,
                'user_id' => 1,
                'product_id' => 15,
                'rating' => 5,
                'comment' => 'good product',
                'reply' => 'thank you <3',
                'created_at' => '2024-11-13 10:04:25',
            ],
            [
                'id' => 6,
                'user_id' => 2,
                'product_id' => 15,
                'rating' => 5,
                'comment' => 'fast shipping',
                'reply' => 'hehe',
                'created_at' => '2024-11-13 10:04:43',
            ],
            [
                'id' => 7,
                'user_id' => 2,
                'product_id' => 4,
                'rating' => 4,
                'comment' => 'low price but high quality',
                'reply' => 'ok ní',
                'created_at' => '2024-11-05 09:00:05',
            ],
            [
                'id' => 10,
                'user_id' => 2,
                'product_id' => 1,
                'rating' => 4,
                'comment' => 'beautiful!!!',
                'reply' => null,
                'created_at' => '2024-11-05 09:00:05',
            ],
            [
                'id' => 13,
                'user_id' => 2,
                'product_id' => 3,
                'rating' => 4,
                'comment' => 'not bad',
                'reply' => null,
                'created_at' => '2024-11-05 09:00:05',
            ],
        ]);  
    }
}
