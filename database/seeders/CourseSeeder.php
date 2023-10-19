<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            'name'       => 'Software Developer',
            'crebo'      => 25604,
            'definitive' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('courses')->insert([
            'name'       => 'SEITO21A',
            'crebo'      => 25604,
            'definitive' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
