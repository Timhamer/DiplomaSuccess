<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoreTasks extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coretasks')->insert([
            'course_id'       => '1',
            'name'      => 'Realiseert software',
            'code  ' => 'K1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('coretasks')->insert([
            'course_id'       => '1',
            'name'      => 'Werkt in een ontwikkelteam',
            'code  ' => 'K2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
