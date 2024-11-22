<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BankAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bank_accounts')->insert([
            [
                'user_id' => 1,
                'bank_name' => 'Vietcombank',
                'card_number' => '0123456789',
                'card_holder_name' => 'Thuận',
                'issue_date' => '2023-01-01',
                'expiry_date' => '12/25',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'bank_name' => 'Sacombank',
                'card_number' => '0987654321',
                'card_holder_name' => 'Thái',
                'issue_date' => '2022-05-15',
                'expiry_date' => '11/24',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'user_id' => 3,
                'bank_name' => 'MB Bank',
                'card_number' => '0987654321',
                'card_holder_name' => 'Hoàng',
                'issue_date' => '2022-05-15',
                'expiry_date' => '11/24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 12,
                'bank_name' => 'SCB Bank',
                'card_number' => '0987654321',
                'card_holder_name' => 'Chiêu',
                'issue_date' => '2022-05-15',
                'expiry_date' => '11/24',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}