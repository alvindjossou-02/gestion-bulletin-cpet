<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer toutes les permissions
        $permissions = [
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'consulter_propres_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
            'enregistrer_absences',
            'consulter_audit_logs',
            'gerer_utilisateurs',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Créer les rôles s'ils n'existent pas
        $administrateur = Role::firstOrCreate(['name' => 'administrateur']);
        $directeur = Role::firstOrCreate(['name' => 'directeur']);
        $professeur = Role::firstOrCreate(['name' => 'professeur']);
        $apprenant = Role::firstOrCreate(['name' => 'apprenant']);

        // Assigner les permissions aux rôles
        $administrateur->syncPermissions($permissions);
        
        $directeur->syncPermissions([
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
            'enregistrer_absences',
            'consulter_audit_logs',
        ]);
        
        $professeur->syncPermissions([
            'saisir_notes',
            'generer_bulletins_pdf',
            'enregistrer_absences',
        ]);
        
        $apprenant->syncPermissions([
            'consulter_propres_notes',
        ]);
    }
}
