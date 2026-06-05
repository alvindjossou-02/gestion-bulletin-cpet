<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // S'assurer que les utilisateurs ont les bons rôles
        // Parcourir tous les utilisateurs et assigner des rôles par défaut si nécessaire
        User::where('role', '!=', null)->update(['role' => 'professeur']);
        
        // Assigner le rôle 'professeur' à tous les utilisateurs sans rôle
        foreach (User::all() as $user) {
            if (!$user->hasRole(['administrateur', 'directeur', 'professeur', 'apprenant'])) {
                $user->assignRole('professeur');
            }
        }
    }
}
