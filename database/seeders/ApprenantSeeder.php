<?php

namespace Database\Seeders;

use App\Models\Apprenant;
use App\Models\Classe;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Database\Seeder;

class ApprenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer des apprenants avec des utilisateurs associés
        $filieres = Filiere::all();
        $classes = Classe::all();

        $apprenants_data = [
            ['nom' => 'Diallo', 'prenom' => 'Mamadou', 'matricule' => 'APP001', 'sexe' => 'M', 'date_naissance' => '2005-01-15', 'lieu_naissance' => 'Conakry'],
            ['nom' => 'Bah', 'prenom' => 'Oumou', 'matricule' => 'APP002', 'sexe' => 'F', 'date_naissance' => '2005-03-22', 'lieu_naissance' => 'Kindia'],
            ['nom' => 'Kourouma', 'prenom' => 'Alpha', 'matricule' => 'APP003', 'sexe' => 'M', 'date_naissance' => '2005-05-10', 'lieu_naissance' => 'Mamou'],
            ['nom' => 'Sow', 'prenom' => 'Aïssatou', 'matricule' => 'APP004', 'sexe' => 'F', 'date_naissance' => '2005-07-18', 'lieu_naissance' => 'Kindian'],
            ['nom' => 'Cissé', 'prenom' => 'Moussa', 'matricule' => 'APP005', 'sexe' => 'M', 'date_naissance' => '2005-09-25', 'lieu_naissance' => 'Labé'],
            ['nom' => 'Ndiaye', 'prenom' => 'Fatou', 'matricule' => 'APP006', 'sexe' => 'F', 'date_naissance' => '2005-11-08', 'lieu_naissance' => 'Boké'],
            ['nom' => 'Traore', 'prenom' => 'Ibrahim', 'matricule' => 'APP007', 'sexe' => 'M', 'date_naissance' => '2005-02-20', 'lieu_naissance' => 'Forécariah'],
            ['nom' => 'Fofana', 'prenom' => 'Mariama', 'matricule' => 'APP008', 'sexe' => 'F', 'date_naissance' => '2005-04-12', 'lieu_naissance' => 'Guéckédou'],
            ['nom' => 'Condé', 'prenom' => 'Sanda', 'matricule' => 'APP009', 'sexe' => 'M', 'date_naissance' => '2005-06-05', 'lieu_naissance' => 'Gaoual'],
            ['nom' => 'Soko', 'prenom' => 'Yacine', 'matricule' => 'APP010', 'sexe' => 'F', 'date_naissance' => '2005-08-30', 'lieu_naissance' => 'Macenta'],
        ];

        foreach ($apprenants_data as $index => $data) {
            // Créer un utilisateur pour l'apprenant
            $user = User::firstOrCreate(
                ['email' => strtolower($data['prenom'] . '.' . $data['nom'] . '@cpet.edu.gu')],
                [
                    'name' => $data['prenom'] . ' ' . $data['nom'],
                    'password' => bcrypt('password123'),
                    'email_verified_at' => now(),
                ]
            );

            // Assigner le rôle apprenant
            $user->assignRole('apprenant');

            // Créer l'apprenant
            Apprenant::firstOrCreate(
                ['matricule' => $data['matricule']],
                [
                    'nom' => $data['nom'],
                    'prenom' => $data['prenom'],
                    'user_id' => $user->id,
                    'sexe' => $data['sexe'],
                    'date_naissance' => $data['date_naissance'],
                    'lieu_naissance' => $data['lieu_naissance'],
                    'filiere_id' => $filieres->count() > 0 ? $filieres->random()->id : 1,
                    'classe_id' => $classes->count() > 0 ? $classes->random()->id : 1,
                    'reboublant' => false,
                ]
            );
        }
    }
}

