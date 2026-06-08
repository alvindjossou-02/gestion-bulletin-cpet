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
            'gerer_classes_filieres',       // Gérer les classes/filières (Administrateur, Secrétaire, Directrice)
            'gerer_apprenants',             // Gérer les apprenants (Administrateur, Secrétaire, Surveillant, Directrice)
            'saisir_notes',                 // Saisir les notes (Administrateur, Enseignant, Surveillant, Directrice)
            'enregistrer_absences',         // Enregistrer les absences (Administrateur, Enseignant, Directrice)
            'consulter_propres_notes',      // Consulter ses propres notes (Apprenant)
            'consulter_notes',              // Consulter les notes des autres (Administrateur, Enseignant, Surveillant, Directrice)
            'generer_bulletins_pdf',        // Générer les bulletins PDF (Administrateur, Enseignant, Surveillant, Directrice)
            'consulter_statistiques',       // Consulter les statistiques (Administrateur, Secrétaire, Surveillant, Directrice)
            'consulter_audit_logs',         // Consulter les logs d'audit (Administrateur, Directrice)
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
            'consulter_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
            'consulter_audit_logs',
        ]);

        // 2. ENSEIGNANT
        $roleEnseignant = Role::firstOrCreate(['name' => 'enseignant'], ['guard_name' => 'web']);
        $roleEnseignant->syncPermissions([
            'saisir_notes',
            'enregistrer_absences',
            'consulter_notes',
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
            'consulter_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        // 5. COMPTABLE
        $roleComptable = Role::firstOrCreate(['name' => 'comptable'], ['guard_name' => 'web']);
        $roleComptable->syncPermissions([
            'consulter_statistiques',
            'consulter_notes',
        ]);

        // 6. SURVEILLANT GÉNÉRAL
        $roleSurveillant = Role::firstOrCreate(['name' => 'surveillant_general'], ['guard_name' => 'web']);
        $roleSurveillant->syncPermissions([
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'consulter_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
        ]);

        // 7. DIRECTRICE
        $roleDirectrice = Role::firstOrCreate(['name' => 'directrice'], ['guard_name' => 'web']);
        $roleDirectrice->syncPermissions([
            'gerer_utilisateurs',
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'consulter_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
            'consulter_audit_logs',
        ]);

        // Keep "directeur" for backwards compatibility, same as "directrice"
        $roleDirecteur = Role::firstOrCreate(['name' => 'directeur'], ['guard_name' => 'web']);
        $roleDirecteur->syncPermissions([
            'gerer_utilisateurs',
            'gerer_classes_filieres',
            'gerer_apprenants',
            'saisir_notes',
            'enregistrer_absences',
            'consulter_notes',
            'generer_bulletins_pdf',
            'consulter_statistiques',
            'consulter_audit_logs',
        ]);

        $this->command->info('Rôles et permissions créés avec succès!');
    }
}
