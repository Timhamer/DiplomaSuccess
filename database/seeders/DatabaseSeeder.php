<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CoreTasksSeeder;
use Database\Seeders\WorkProcessesSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        UserSeeder::class,
        CourseSeeder::class,
        CoreTasksSeeder::class,
        WorkProcessesSeeder::class,
        TasksSeeder::class
            ]);
    }
}
