<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Test Product',
            'category' => 'Electronics',
            'price' => 99.99,
            'description' => 'This is a test.',
            'image' => null,
            'status' => 'active',
        ]);
    }
}
