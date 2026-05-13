<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Réinitialiser le cache de Spatie
        app()['cache']->forget('spatie.permission.cache');

        // Définir les permissions selon le tableau
        $permissions = [
            'gerer_utilisateurs',           // Gérer les utilisateurs (Administrateur)
            'gerer_classes_filieres',       // Gérer les classes/filières (Administrateur, Secrétaire, Directeur)
            'gerer_apprenants',             // Gérer les apprenants (Administrateur, Secrétaire, Surveillant, Directeur)
            'saisir_notes',                 // Saisir les notes (Administrateur, Enseignant, Surveillant, Directeur)
            'enregistrer_absences',         // Enregistrer les absences (Administrateur, Enseignant, Directeur)
            'consulter_propres_notes',      // Consulter ses propres notes (Apprenant)
            'generer_bulletins_pdf',        // Générer les bulletins PDF (Administrateur, Enseignant, Comptable, Surveillant, Directeur)
            'consulter_statistiques',       // Consulter les statistiques (Administrateur, Secrétaire, Comptable, Surveillant, Directeur)
        ];

        // Créer les permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission], ['guard_name' => 'web']);
        }

        // 1. ADMINISTRATEUR
        $roleAdmin = Role::firstOrCreate(['name' => 'administrateur'], ['guard_name' => 'web']);
        $roleAdmin->syncPermissions([
            'gerer_utilisateurs',
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        // 2. ENSEIGNANT
        $roleEnseignant = Role::firstOrCreate(['name' => 'enseignant'], ['guard_name' => 'web']);
        $roleEnseignant->syncPermissions([
            'saisir_notes',
            'enregistrer_absences',
            'generer_bulletins_pdf',
        ]);

        // 3. APPRENANT
        $roleApprenant = Role::firstOrCreate(['name' => 'apprenant'], ['guard_name' => 'web']);
        $roleApprenant->syncPermissions([
            'consulter_propres_notes',
        ]);

        // 4. SECRÉTAIRE
        $roleSecretaire = Role::firstOrCreate(['name' => 'secretaire'], ['guard_name' => 'web']);
        $roleSecretaire->syncPermissions([
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        // 5. COMPTABLE
        $roleComptable = Role::firstOrCreate(['name' => 'comptable'], ['guard_name' => 'web']);
        $roleComptable->syncPermissions([
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        // 6. SURVEILLANT GÉNÉRAL
        $roleSurveillant = Role::firstOrCreate(['name' => 'surveillant_general'], ['guard_name' => 'web']);
        $roleSurveillant->syncPermissions([
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        // 7. DIRECTEUR
        $roleDirecteur = Role::firstOrCreate(['name' => 'directeur'], ['guard_name' => 'web']);
        $roleDirecteur->syncPermissions([
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        $this->command->info('Rôles et permissions créés avec succès!');
    }
}
