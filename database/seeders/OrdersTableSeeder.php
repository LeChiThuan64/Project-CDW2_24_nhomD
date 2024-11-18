<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id' => 1234,
                'user_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'street_address' => '123 Main St',
                'city' => 'New York',
                'zipcode' => '10001',
                'phone' => '123-456-7890',
                'email' => 'john.doe@gmail.com',
                'country' => 'USA',
                'voucher_discount' => 10,
                'subtotal' => 100.00,
                'shipping_price' => 5.00,
                'total' => 95.00,
                'payment_method' => 'cash_on_delivery',
                'status' => 'pending',
                'note' => 'Please deliver between 9 AM and 5 PM.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 5678,
                'user_id' => 2,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'street_address' => '456 Elm St',
                'city' => 'Los Angeles',
                'zipcode' => '90001',
                'phone' => '987-654-3210',
                'email' => 'jane.smith@gmail.com',
                'country' => 'USA',
                'voucher_discount' => 15,
                'subtotal' => 200.00,
                'shipping_price' => 10.00,
                'total' => 185.00,
                'payment_method' => 'Direct bank transfer',
                'status' => 'on delivery',
                'note' => 'Leave at the front door.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9012,
                'user_id' => 3,
                'first_name' => 'Alice',
                'last_name' => 'Johnson',
                'street_address' => '789 Oak St',
                'city' => 'Chicago',
                'zipcode' => '60601',
                'phone' => '555-123-4567',
                'email' => 'alice.johnson@gmail.com',
                'country' => 'USA',
                'voucher_discount' => 20,
                'subtotal' => 150.00,
                'shipping_price' => 7.50,
                'total' => 142.50,
                'payment_method' => 'direct bank transfer',
                'status' => 'delivered',
                'note' => 'Ring the doorbell.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'id' => 7892,
                'user_id' => 6,
                'first_name' => 'Bob',
                'last_name' => 'Brown',
                'street_address' => '321 Pine St',
                'city' => 'San Francisco',
                'zipcode' => '94101',
                'phone' => '444-555-6666',
                'email' => 'bob.brown@gmail.com',
                'country' => 'USA',
                'voucher_discount' => 5,
                'subtotal' => 250.00,
                'shipping_price' => 12.00,
                'total' => 238.00,
                'payment_method' => 'cash_on_delivery',
                'status' => 'order fails',
                'note' => 'Call upon arrival.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}