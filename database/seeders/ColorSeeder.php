<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder {
    public function run() {
        DB::table('colors')->insert([
            ['name' => 'Đen'],
            ['name' => 'Đỏ'],
            ['name' => 'Xám'],
        ]);
    }
}
