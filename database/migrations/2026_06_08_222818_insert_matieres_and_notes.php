<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get filière IDs dynamically
        $filieresMap = [
            'Électronique & Informatique' => DB::table('filieres')->where('nom_filiere', 'Électronique & Informatique')->value('id'),
            'Génie Civil' => DB::table('filieres')->where('nom_filiere', 'Génie Civil')->value('id'),
            'Mécanique Générale' => DB::table('filieres')->where('nom_filiere', 'Mécanique Générale')->value('id'),
        ];

        $classesMap = [
            'ELEC 1A' => DB::table('classes')->where('nom_classe', 'ELEC 1A')->value('id'),
            'ELEC 2A' => DB::table('classes')->where('nom_classe', 'ELEC 2A')->value('id'),
            'GC 1A' => DB::table('classes')->where('nom_classe', 'GC 1A')->value('id'),
            'MECA 1A' => DB::table('classes')->where('nom_classe', 'MECA 1A')->value('id'),
        ];

        // Insert Matières
        $matieresData = [
            ['nom_matiere' => 'Programmation C', 'coefficient' => 3.0, 'filiere' => 'Électronique & Informatique', 'classe' => 'ELEC 1A'],
            ['nom_matiere' => 'Électronique Numérique', 'coefficient' => 2.5, 'filiere' => 'Électronique & Informatique', 'classe' => 'ELEC 1A'],
            ['nom_matiere' => 'Algèbre Linéaire', 'coefficient' => 2.0, 'filiere' => 'Électronique & Informatique', 'classe' => 'ELEC 1A'],
            ['nom_matiere' => 'Programmation Java', 'coefficient' => 3.0, 'filiere' => 'Électronique & Informatique', 'classe' => 'ELEC 2A'],
            ['nom_matiere' => 'Bases de Données', 'coefficient' => 2.5, 'filiere' => 'Électronique & Informatique', 'classe' => 'ELEC 2A'],
            ['nom_matiere' => 'Calcul des Structures', 'coefficient' => 3.0, 'filiere' => 'Génie Civil', 'classe' => 'GC 1A'],
            ['nom_matiere' => 'Topographie', 'coefficient' => 2.5, 'filiere' => 'Génie Civil', 'classe' => 'GC 1A'],
            ['nom_matiere' => 'Matériaux de Construction', 'coefficient' => 2.0, 'filiere' => 'Génie Civil', 'classe' => 'GC 1A'],
            ['nom_matiere' => 'Technologie Mécanique', 'coefficient' => 3.0, 'filiere' => 'Mécanique Générale', 'classe' => 'MECA 1A'],
            ['nom_matiere' => 'Thermodynamique', 'coefficient' => 2.5, 'filiere' => 'Mécanique Générale', 'classe' => 'MECA 1A'],
        ];

        $matieresIds = [];
        foreach ($matieresData as $matiere) {
            $filiere_id = $filieresMap[$matiere['filiere']];
            $classe_id = $classesMap[$matiere['classe']];
            
            if ($filiere_id && $classe_id) {
                $id = DB::table('matieres')->insertGetId([
                    'nom_matiere' => $matiere['nom_matiere'],
                    'coefficient' => $matiere['coefficient'],
                    'filiere_id' => $filiere_id,
                    'classe_id' => $classe_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $matieresIds[] = $id;
            }
        }

        // Insert Notes for Apprenants
        $apprenants = DB::table('apprenants')->pluck('id');
        $matieres = DB::table('matieres')->pluck('id');
        $evaluationTypes = ['Devoir', 'Interrogation'];

        // Create 5-8 notes per apprenant
        foreach ($apprenants as $apprenant_id) {
            $notesCount = rand(5, 8);
            for ($i = 0; $i < $notesCount; $i++) {
                $matiere_id = $matieres->random();
                $type = $evaluationTypes[array_rand($evaluationTypes)];
                $note = rand(8, 20);
                
                DB::table('notes')->insertOrIgnore([
                    'apprenant_id' => $apprenant_id,
                    'matiere_id' => $matiere_id,
                    'note' => $note,
                    'type_evaluation' => $type,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clean up notes and matières
        DB::table('notes')->delete();
        DB::table('matieres')->where('nom_matiere', 'like', '%Programmation%')
            ->orWhere('nom_matiere', 'like', '%Électronique%')
            ->orWhere('nom_matiere', 'like', '%Algèbre%')
            ->orWhere('nom_matiere', 'like', '%Bases%')
            ->orWhere('nom_matiere', 'like', '%Calcul%')
            ->orWhere('nom_matiere', 'like', '%Topographie%')
            ->orWhere('nom_matiere', 'like', '%Matériaux%')
            ->orWhere('nom_matiere', 'like', '%Technologie%')
            ->orWhere('nom_matiere', 'like', '%Thermodynamique%')
            ->delete();
    }
};

