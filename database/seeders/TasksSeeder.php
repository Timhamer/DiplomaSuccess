<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tasks')->insert([
            'workprocess_id'       => '1',
            'name'      => 'Ontwerp',
            'crucial' => 0,
            'type' => 0,
            'description' => 'De user stories zijn vertaald naar een passend, eevoudig en volledig ontwerp (sluit aan op wensen en eisen).',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '1',
            'name'      => 'Scema-technieken',
            'crucial' => 0,
            'type' => 1,

            'description' => 'Er is gebruik gemaakt van relevante of toepasselijke schematechnieken (bijv. activiteitsdiagrammen, klassendiagram, ERD, usecase diagram)',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '1',
            'name'      => 'Onderbouwing',
            'crucial' => 0,
            'type' => 0,

            'description' => 'De gemaakt keuzes in het ontwerp zijn onderbouwd met steekhoudende argumenten, waarbij rekening is gehouden met bijv. ethiek, privacy en security',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '2',
            'name'      => 'Gerealiseerde user stories',
            'crucial' => 0,
            'type' => 1,

            'description' => 'Er is voldoende inhoud van de user stories gerealiseerd binnen de gestelde/geplande tijd',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '2',
            'name'      => 'Kwaliteit opgeleverde functionaliteiten',
            'crucial' => 0,
            'type' => 0,

            'description' => 'De opgeleverde functionaliteiten voldoen aan de eisen en wensen zoals omschreven in de betreffende user story',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '3',
            'name'      => 'Actieve deelname',
            'crucial' => 0,
            'type' => 0,

            'description' => 'Er is gebruik gemaakt van relevante of toepasselijke schematechnieken (bijv. activiteitsdiagrammen, klassendiagram, ERD, usecase diagram)',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '3',
            'name'      => 'Afstemmen',
            'crucial' => 0,
            'type' => 1,

            'description' => 'De gemaakt keuzes in het ontwerp zijn onderbouwd met steekhoudende argumenten, waarbij rekening is gehouden met bijv. ethiek, privacy en security',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '3',
            'name'      => 'Afspraken vastleggen',
            'crucial' => 0,
            'type' => 0,

            'description' => 'Er is voldoende inhoud van de user stories gerealiseerd binnen de gestelde/geplande tijd',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '3',
            'name'      => 'Afspraken nakomen',
            'crucial' => 0,
            'type' => 1,

            'description' => 'De opgeleverde functionaliteiten voldoen aan de eisen en wensen zoals omschreven in de betreffende user story',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tasks')->insert([
            'workprocess_id'       => '4',
            'name'      => 'Presentatie',
            'crucial' => 0,
            'type' => 0,

            'description' => 'De kandidaat presenteert een overtuigend, duidelijk beargumenteerd verhaal, afgestemd op de doelgroep.',
            'zero' => 'Niet of nauwelijks',
            'one' => 'Enigzins',
            'two' => 'Grotendeels',
            'three' => 'Volledig',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
