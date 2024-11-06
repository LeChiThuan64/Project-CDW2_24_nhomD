<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder {
    public function run() {
        DB::table('colors')->insert([
            ['name' => 'Đen', 'color_code' => '#222'],
            ['name' => 'Đỏ', 'color_code' => '#C93A3E'],
            ['name' => 'Xám', 'color_code' => '#E4E4E4'],
        ]);
        
    }
}
