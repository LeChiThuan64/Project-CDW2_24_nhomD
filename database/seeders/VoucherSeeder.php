<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('vocher')->insert([
            [
                'id' => 1,
                'user_id' => null,
                'is_global' => 1,
                'name' => 'chung',
                'description' => 'ch',
                'discount' => 100.00,
                'start_date' => '2024-11-07',
                'end_date' => '2024-11-08',
                'created_at' => '2024-11-06 02:24:35',
                'updated_at' => '2024-11-06 02:24:35',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'is_global' => 0,
                'name' => 'rieng',
                'description' => 'rieng',
                'discount' => 99.00,
                'start_date' => '2024-11-10',
                'end_date' => '2024-11-27',
                'created_at' => '2024-11-06 02:25:12',
                'updated_at' => '2024-11-06 02:25:12',
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'is_global' => 0,
                'name' => '11',
                'description' => '11',
                'discount' => 11.00,
                'start_date' => '2024-11-08',
                'end_date' => '2024-11-15',
                'created_at' => '2024-11-06 02:33:07',
                'updated_at' => '2024-11-06 02:33:07',
            ],
        ]);
    }
}
