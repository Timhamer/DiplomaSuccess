<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkProcessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('workprocesses')->insert([
            'coretask_id'       => '1',
            'name'      => 'Plant werkzaamheden en bewaakt de voortgang',
            'code' => 'W1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('workprocesses')->insert([
            'coretask_id'       => '1',
            'name'      => 'Ontwerpt software',
            'code' => 'W2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('workprocesses')->insert([
            'coretask_id'       => '2',
            'name'      => 'Plant werkzaamheden en bewaakt de voortgang',
            'code' => 'W1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('workprocesses')->insert([
            'coretask_id'       => '2',
            'name'      => 'Ontwerpt software',
            'code' => 'W2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
