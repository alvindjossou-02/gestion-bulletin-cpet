<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Apprenant;
use App\Models\Matiere;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apprenants = Apprenant::all();
        $matieres = Matiere::all();
        $types = ['Devoir', 'Interrogation'];

        // Créer des notes pour chaque apprenant
        foreach ($apprenants as $apprenant) {
            // 5-8 notes par apprenant
            $nombre_notes = rand(5, 8);

            for ($i = 0; $i < $nombre_notes; $i++) {
                Note::create([
                    'apprenant_id' => $apprenant->id,
                    'matiere_id' => $matieres->random()->id,
                    'note' => rand(8, 20), // Notes entre 8 et 20
                    'type_evaluation' => $types[array_rand($types)],
                    'date_evaluation' => now()->subDays(rand(1, 30)),
                    'observation' => 'Note saisie lors du test',
                ]);
            }
        }
    }
}

