<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 39; $i++) {
            DB::table('users')->insert([
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => Hash::make('password' . $i),
                'phone' => '09000000' . $i,
                'address' => 'Address ' . $i,
                'role' => rand(0, 1),  // Giá trị 'role' sẽ ngẫu nhiên là 0 hoặc 1
                'created_at' => now(),
            ]);
        }
    }
}
