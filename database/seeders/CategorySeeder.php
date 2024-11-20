<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_name' => 'Men',
                'description' => 'Fashionable clothing for men',
                'image' => 'grid_banner_1.jpg',
                'created_at' => now(),
            ],
            [
                'category_name' => 'Women',
                'description' => 'Fashionable clothing for men',
                'image' => 'grid_banner_2.jpg',
                'created_at' => now(),
            ],
            [
                'category_name' => 'Kids',
                'description' => 'Fashionable clothing for kid',
                'image' => 'grid_banner_3.jpg',
                'created_at' => now(),
            ],
        ]);
    }
}

