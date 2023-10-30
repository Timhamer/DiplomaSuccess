<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkProcesses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workprocesses')->insert([
            'coretask_id'       => '1',
            'name'      => 'Plant werkzaamheden en bewaakt de voortgang',
            'definitive  ' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('workprocesses')->insert([
            'coretask_id'       => '1',
            'name'      => 'Werkt in een ontwikkelteam',
            'code  ' => 'K2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
