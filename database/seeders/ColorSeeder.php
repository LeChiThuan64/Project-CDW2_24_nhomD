<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder {
    public function run() {
        DB::table('colors')->insert([
            [
                'id' => 1,
                'name' => 'Black',
                'created_at' => null,
                'updated_at' => null,
                'color_code' => '#222',
            ],
            [
                'id' => 2,
                'name' => 'Red',
                'created_at' => null,
                'updated_at' => null,
                'color_code' => '#C93A3E',
            ],
            [
                'id' => 3,
                'name' => 'Gray',
                'created_at' => null,
                'updated_at' => null,
                'color_code' => '#E4E4E4',
            ],
        ]); 
        
    }
}
