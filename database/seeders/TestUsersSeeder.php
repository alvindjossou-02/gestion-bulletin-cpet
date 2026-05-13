<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nettoyer les utilisateurs existants (sauf le premier)
        $existingUsers = [
            'admin@cpet.com',
            'enseignant@cpet.com',
            'apprenant@cpet.com',
            'secretaire@cpet.com',
            'comptable@cpet.com',
            'surveillant@cpet.com',
            'directeur@cpet.com',
        ];

        foreach ($existingUsers as $email) {
            User::where('email', $email)->delete();
        }

        // 1. ADMINISTRATEUR
        $admin = User::create([
            'name' => 'Admin CPET',
            'email' => 'admin@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'administrateur',
        ]);
        $admin->assignRole('administrateur');

        // 2. ENSEIGNANT
        $enseignant = User::create([
            'name' => 'Prof Jean Dupont',
            'email' => 'enseignant@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'enseignant',
        ]);
        $enseignant->assignRole('enseignant');

        // 3. APPRENANT
        $apprenant = User::create([
            'name' => 'Apprenant Marie Martin',
            'email' => 'apprenant@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'apprenant',
        ]);
        $apprenant->assignRole('apprenant');

        // 4. SECRÉTAIRE
        $secretaire = User::create([
            'name' => 'Secrétaire Sophie Bernard',
            'email' => 'secretaire@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'secretaire',
        ]);
        $secretaire->assignRole('secretaire');

        // 5. COMPTABLE
        $comptable = User::create([
            'name' => 'Comptable Pierre Leblanc',
            'email' => 'comptable@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'comptable',
        ]);
        $comptable->assignRole('comptable');

        // 6. SURVEILLANT GÉNÉRAL
        $surveillant = User::create([
            'name' => 'Surveillant Laurent Petit',
            'email' => 'surveillant@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'surveillant_general',
        ]);
        $surveillant->assignRole('surveillant_general');

        // 7. DIRECTEUR
        $directeur = User::create([
            'name' => 'Directeur Marc Rousseau',
            'email' => 'directeur@cpet.com',
            'password' => bcrypt('password123'),
            'role' => 'directeur',
        ]);
        $directeur->assignRole('directeur');

        $this->command->info('7 utilisateurs de test créés avec succès!');
        $this->command->info('');
        $this->command->info('Identifiants de test:');
        $this->command->table(
            ['Rôle', 'Email', 'Mot de passe'],
            [
                ['Administrateur', 'admin@cpet.com', 'password123'],
                ['Enseignant', 'enseignant@cpet.com', 'password123'],
                ['Apprenant', 'apprenant@cpet.com', 'password123'],
                ['Secrétaire', 'secretaire@cpet.com', 'password123'],
                ['Comptable', 'comptable@cpet.com', 'password123'],
                ['Surveillant Général', 'surveillant@cpet.com', 'password123'],
                ['Directeur', 'directeur@cpet.com', 'password123'],
            ]
        );
    }
}
