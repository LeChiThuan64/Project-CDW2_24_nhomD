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
                'user_id' => 1,
                'product_id' => 1,
                'rating' => 4,
                'comment' => 'good',
                'created_at' => now()
            ],
            [
                'user_id' => 2,
                'product_id' => 1,
                'rating' => 5,
                'comment' => 'excellent',
                'created_at' => now()
            ]
        ]);
        
    }
}
