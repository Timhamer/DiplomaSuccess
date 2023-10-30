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
            'last_name' => 'Hammersma',
            'email' => 'Tfhammersma@gmail.com',
            'student_id' => 240159,
            'password' => Hash::make('Test1234!'),
            'role' => '1',
            'created_at' => now(),
            'updated_at' => now(),
            'reset_token' => bin2hex(random_bytes(16))
        ]);

        DB::table('users')->insert([
            'first_name' => 'Frans',
            'middle_name' => 'de',
            'last_name' => 'Boer',
            'email' => 'fdeboer@rocfriesepoort.nl',
            'password' => Hash::make('Test1234!'),
            'role' => '2',
            'created_at' => now(),
            'updated_at' => now(),
            'reset_token' => bin2hex(random_bytes(16))
        ]);

        DB::table('courses')->insert([
            'name' => 'Software Developer',
            'crebo' => '250604',
            'definitive' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('exams')->insert([
            'user_id' => '1',
            'course_id' => '1',
            'published' => '1',
            'passed' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
