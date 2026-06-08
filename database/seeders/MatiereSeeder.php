<?php

namespace Database\Seeders;

use App\Models\Matiere;
use App\Models\Filiere;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Électronique & Informatique
        $electro = Filiere::where('nom_filiere', 'Électronique & Informatique')->first();
        if ($electro) {
            $matieres_electro = [
                ['nom_matiere' => 'Programmation C', 'coefficient' => 3],
                ['nom_matiere' => 'Électronique Numérique', 'coefficient' => 3],
                ['nom_matiere' => 'Algèbre Linéaire', 'coefficient' => 2],
                ['nom_matiere' => 'Systèmes Numériques', 'coefficient' => 2.5],
                ['nom_matiere' => 'Architecture Informatique', 'coefficient' => 2.5],
            ];
            foreach ($matieres_electro as $mat) {
                Matiere::firstOrCreate(
                    ['nom_matiere' => $mat['nom_matiere'], 'filiere_id' => $electro->id],
                    ['coefficient' => $mat['coefficient']]
                );
            }
        }

        // Génie Civil
        $gc = Filiere::where('nom_filiere', 'Génie Civil')->first();
        if ($gc) {
            $matieres_gc = [
                ['nom_matiere' => 'Mécanique des Structures', 'coefficient' => 3],
                ['nom_matiere' => 'Béton Armé', 'coefficient' => 3],
                ['nom_matiere' => 'Géotechnique', 'coefficient' => 2.5],
                ['nom_matiere' => 'Topographie', 'coefficient' => 2],
                ['nom_matiere' => 'CAO - AutoCAD', 'coefficient' => 2],
            ];
            foreach ($matieres_gc as $mat) {
                Matiere::firstOrCreate(
                    ['nom_matiere' => $mat['nom_matiere'], 'filiere_id' => $gc->id],
                    ['coefficient' => $mat['coefficient']]
                );
            }
        }

        // Mécanique Générale
        $meca = Filiere::where('nom_filiere', 'Mécanique Générale')->first();
        if ($meca) {
            $matieres_meca = [
                ['nom_matiere' => 'Mécanique des Fluides', 'coefficient' => 3],
                ['nom_matiere' => 'Thermodynamique', 'coefficient' => 3],
                ['nom_matiere' => 'Machines Thermiques', 'coefficient' => 2.5],
                ['nom_matiere' => 'Moteurs Combustion', 'coefficient' => 2.5],
                ['nom_matiere' => 'CAO - SolidWorks', 'coefficient' => 2],
            ];
            foreach ($matieres_meca as $mat) {
                Matiere::firstOrCreate(
                    ['nom_matiere' => $mat['nom_matiere'], 'filiere_id' => $meca->id],
                    ['coefficient' => $mat['coefficient']]
                );
            }
        }
    }
}

