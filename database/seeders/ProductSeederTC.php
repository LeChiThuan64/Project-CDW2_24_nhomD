<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeederTC extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_id' => 1,
                'name' => 'Sản phẩm A',
                'description' => 'Sản phẩm chất lượng cao',
                'price' => 100000,
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 2,
                'name' => 'Sản phẩm B',
                'description' => 'Sản phẩm bán chạy',
                'price' => 150000,
                'category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 3,
                'name' => 'Sản phẩm C',
                'description' => 'Phiên bản giới hạn',
                'price' => 80000,
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 4,
                'name' => 'Sản phẩm D',
                'description' => 'Thân thiện với môi trường',
                'price' => 120000,
                'category_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 5,
                'name' => 'Sản phẩm E',
                'description' => 'Chất lượng cao cấp',
                'price' => 110000,
                'category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 6,
                'name' => 'Sản phẩm F',
                'description' => 'Giá cả phải chăng',
                'price' => 90000,
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 7,
                'name' => 'Sản phẩm G',
                'description' => 'Vật liệu bền bỉ',
                'price' => 140000,
                'category_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 8,
                'name' => 'Sản phẩm H',
                'description' => 'Sự lựa chọn phổ biến',
                'price' => 105000,
                'category_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 9,
                'name' => 'Sản phẩm I',
                'description' => 'Sản phẩm mới',
                'price' => 130000,
                'category_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'product_id' => 10,
                'name' => 'Sản phẩm J',
                'description' => 'Ưu đãi độc quyền',
                'price' => 95000,
                'category_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
