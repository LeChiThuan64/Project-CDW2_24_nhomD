<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shipping_price')->insert([
            ['name' => 'Giao hàng nhanh', 'price' => 35000],
            ['name' => 'Giao hàng tiết kiệm', 'price' => 20000],
            ['name' => 'Giao hoả tốc', 'price' => 60000],
        ]);
    }
}