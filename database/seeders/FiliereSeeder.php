<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = [
            ['nom_filiere' => 'Électronique & Informatique', 'description' => 'Formation en électronique et informatique'],
            ['nom_filiere' => 'Génie Civil', 'description' => 'Formation en génie civil et construction'],
            ['nom_filiere' => 'Mécanique Générale', 'description' => 'Formation en mécanique générale'],
            ['nom_filiere' => 'Gestion Administrative', 'description' => 'Formation en gestion administrative'],
            ['nom_filiere' => 'Commerce & Marketing', 'description' => 'Formation en commerce et marketing'],
        ];

        foreach ($filieres as $filiere) {
            Filiere::firstOrCreate(
                ['nom_filiere' => $filiere['nom_filiere']],
                $filiere
            );
        }
    }
}

