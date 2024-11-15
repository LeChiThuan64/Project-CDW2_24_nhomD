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
        // for ($i = 1; $i <= 39; $i++) {
        //     DB::table('users')->insert([
        //         'name' => 'User ' . $i,
        //         'email' => 'user' . $i . '@example.com',
        //         'password' => Hash::make('password' . $i),
        //         'phone' => '09000000' . $i,
        //         'address' => 'Address ' . $i,
        //         'role' => rand(0, 1),  // Giá trị 'role' sẽ ngẫu nhiên là 0 hoặc 1
        //         'created_at' => now(),
        //     ]);
        // }
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'thuan',
                'email' => 'thuan@gmail.com',
                'password' => '1234',
                'phone' => '0987456123',
                'role' => 1,
                'gender' => 'male',
                'dob' => '2014-11-04',
                'is_active' => 1,
                'profile_image' => 'uploads/team-4.jpg',
                'created_at' => '2024-11-12 09:29:57',
                'updated_at' => '2024-11-11 22:00:42',
            ],
            [
                'id' => 2,
                'name' => 'thai',
                'email' => 'aaa@gmail.com',
                'password' => '$2y$10$X8yYOYTZ1.Dx27yUXD/s9Oez7jKPnx9HrSKLEfZ05R5...', // Mã hóa sẵn
                'phone' => '0456789123',
                'role' => 1,
                'gender' => 'female',
                'dob' => '2004-11-13',
                'is_active' => 1,
                'profile_image' => 'uploads/team-4.jpg',
                'created_at' => '2024-11-06 02:22:18',
                'updated_at' => '2024-11-11 03:49:03',
            ],
            [
                'id' => 3,
                'name' => 'hoang',
                'email' => 'hoang@gmail.com',
                'password' => '1234',
                'phone' => '0123456897',
                'role' => 1,
                'gender' => 'male',
                'dob' => '2004-11-13',
                'is_active' => 1,
                'profile_image' => 'uploads/team-4.jpg',
                'created_at' => '2024-11-09 07:52:31',
                'updated_at' => '2024-11-04 22:00:52',
            ],
            [
                'id' => 6,
                'name' => 'lequocthai',
                'email' => 'thai@gmail.com',
                'password' => '$2y$10$VRtIddHiJs3D3alValIp9usKCTD1oGfh1ydZ80egxO5...', // Mã hóa sẵn
                'phone' => '1234567890',
                'role' => 1,
                'gender' => 'male',
                'dob' => '2004-11-13',
                'is_active' => 1,
                'profile_image' => 'uploads/team-4.jpg',
                'created_at' => '2024-11-13 01:28:53',
                'updated_at' => '2024-11-13 01:28:53',
            ],
        ]);
    }
}
