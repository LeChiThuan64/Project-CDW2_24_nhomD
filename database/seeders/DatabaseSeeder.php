<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // \App\Models\User::factory(10)->create();

    //     // \App\Models\User::factory()->create([
    //     //     'name' => 'Test User',
    //     //     'email' => 'test@example.com',
    //     // ]);

        
    // }

    public function run()
    {
        // Gọi UserSeeder
        // $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductSizeColorSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CartItemSeeder::class);
        $this->call(ShoppingCartSeeder::class);
        $this->call(ProductImagesSeeder::class);
        $this->call(WishlistSeeder::class);
        $this->call(VoucherSeeder::class);
        $this->call(ShippingPriceSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
