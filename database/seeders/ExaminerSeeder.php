<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExaminerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('examiner')->insert([
            'exam_id'       => '1',
            'user_id'      => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
