<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminpassword'),
            'is_verified'=>1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

