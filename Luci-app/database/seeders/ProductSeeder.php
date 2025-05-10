<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
