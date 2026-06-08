<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                RolesAndPermissionsSeeder::class,
                TestUsersSeeder::class,
                FiliereSeeder::class,
                ClasseSeeder::class,
                MatiereSeeder::class,
                ApprenantSeeder::class,
                NoteSeeder::class,
            ]
        );
    }
}
