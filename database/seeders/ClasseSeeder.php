<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            ['nom_classe' => 'ELEC 1A', 'description' => 'Première année Électronique'],
            ['nom_classe' => 'ELEC 2A', 'description' => 'Deuxième année Électronique'],
            ['nom_classe' => 'ELEC 3A', 'description' => 'Troisième année Électronique'],
            ['nom_classe' => 'GC 1A', 'description' => 'Première année Génie Civil'],
            ['nom_classe' => 'GC 2A', 'description' => 'Deuxième année Génie Civil'],
            ['nom_classe' => 'GC 3A', 'description' => 'Troisième année Génie Civil'],
            ['nom_classe' => 'MECA 1A', 'description' => 'Première année Mécanique'],
            ['nom_classe' => 'MECA 2A', 'description' => 'Deuxième année Mécanique'],
            ['nom_classe' => 'GA 1A', 'description' => 'Première année Gestion Admin'],
            ['nom_classe' => 'GA 2A', 'description' => 'Deuxième année Gestion Admin'],
        ];

        foreach ($classes as $classe) {
            Classe::firstOrCreate(
                ['nom_classe' => $classe['nom_classe']],
                $classe
            );
        }
    }
}

