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
                'category_name' => 'Thời trang nam',
                'description' => 'Quần áo thời trang dành cho nam giới',
            ],
            [
                'category_name' => 'Thời trang nữ',
                'description' => 'Quần áo thời trang dành cho nữ giới',
            ],
            [
                'category_name' => 'Phụ kiện',
                'description' => 'Các loại phụ kiện điện tử, thời trang',
            ],
        ]);
    }
}

