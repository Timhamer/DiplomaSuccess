<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Tim',
            'email' => 'Tfhammersma@gmail.com',
            'password' => Hash::make('Test1234!'),
            'role' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
