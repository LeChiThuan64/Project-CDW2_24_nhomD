<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder {
    public function run() {
        DB::table('colors')->insert([
            ['name' => 'Vàng'],
            ['name' => 'Xanh'],
            ['name' => 'Đỏ'],
            ['name' => 'Đen'],
            ['name' => 'Trắng'],
        ]);
    }
}
