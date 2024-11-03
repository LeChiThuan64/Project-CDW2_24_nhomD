<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            [
                'image_url' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/5ffa42df-097c-4977-93ff-d4beb69624b4/AS+M+NSW+AUTHRZD++PERSONNEL+TE.png',
                'product_id' => 1,
            ],
            [
                'image_url' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c398bfaf-cf51-4bfe-9c1f-52b0e9ad1c03/AS+M+NSW+AUTHRZD++PERSONNEL+TE.png',
                'product_id' => 1,
            ],
            [
                'image_url' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/edc37952-0f6f-4584-a714-a693450db5b4/AS+U+ACG+TF+TUFF+FLC+PO+HOODIE.png',
                'product_id' => 2,
            ],
            [
                'image_url' => 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/d063eacd-4796-435b-b4a7-cdde3f3c812a/AS+U+ACG+TF+TUFF+FLC+PO+HOODIE.png',
                'product_id' => 2,
            ],
        ]);
    }
}