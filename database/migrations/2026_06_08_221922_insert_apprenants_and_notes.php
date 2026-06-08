<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get the actual IDs from database instead of hardcoding
        $filieresMap = [
            'Électronique & Informatique' => DB::table('filieres')->where('nom_filiere', 'Électronique & Informatique')->value('id'),
            'Génie Civil' => DB::table('filieres')->where('nom_filiere', 'Génie Civil')->value('id'),
            'Mécanique Générale' => DB::table('filieres')->where('nom_filiere', 'Mécanique Générale')->value('id'),
            'Gestion Administrative' => DB::table('filieres')->where('nom_filiere', 'Gestion Administrative')->value('id'),
            'Commerce & Marketing' => DB::table('filieres')->where('nom_filiere', 'Commerce & Marketing')->value('id'),
        ];

        $classesMap = [
            'ELEC 1A' => DB::table('classes')->where('nom_classe', 'ELEC 1A')->value('id'),
            'ELEC 2A' => DB::table('classes')->where('nom_classe', 'ELEC 2A')->value('id'),
            'ELEC 3A' => DB::table('classes')->where('nom_classe', 'ELEC 3A')->value('id'),
            'GC 1A' => DB::table('classes')->where('nom_classe', 'GC 1A')->value('id'),
            'GC 2A' => DB::table('classes')->where('nom_classe', 'GC 2A')->value('id'),
            'MECA 1A' => DB::table('classes')->where('nom_classe', 'MECA 1A')->value('id'),
            'GA 1A' => DB::table('classes')->where('nom_classe', 'GA 1A')->value('id'),
            'GA 2A' => DB::table('classes')->where('nom_classe', 'GA 2A')->value('id'),
        ];

        // Create test Users for Apprenants (or get existing ones)
        $userEmails = [
            'diallo.mamadou@cpet.com',
            'ndiaye.fatou@cpet.com',
            'kane.ousmane@cpet.com',
            'bah.aissatou@cpet.com',
            'sow.mamadou@cpet.com',
            'cisse.nicole@cpet.com',
            'barry.habib@cpet.com',
            'diop.coumba@cpet.com',
            'fall.seydou@cpet.com',
            'kone.abdoulaye@cpet.com',
        ];

        $userNames = [
            'Mamadou Diallo',
            'Fatou Ndiaye',
            'Ousmane Kane',
            'Aïssatou Bah',
            'Mamadou Sow',
            'Nicole Cissé',
            'Habib Barry',
            'Coumba Diop',
            'Seydou Fall',
            'Abdoulaye Koné',
        ];

        $userIds = [];
        for ($i = 0; $i < count($userEmails); $i++) {
            // Check if user exists
            $user = DB::table('users')->where('email', $userEmails[$i])->first();
            if ($user) {
                $userIds[] = $user->id;
            } else {
                $userId = DB::table('users')->insertGetId([
                    'email' => $userEmails[$i],
                    'name' => $userNames[$i],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $userIds[] = $userId;
            }
        }

        // Create Apprenants with dynamic IDs
        $apprenantData = [
            [1, 'Diallo', 'Mamadou', 'APP0001', 'M', '2005-01-15', 'Conakry', 'Électronique & Informatique', 'ELEC 1A'],
            [2, 'Ndiaye', 'Fatou', 'APP0002', 'F', '2005-03-20', 'Dakar', 'Électronique & Informatique', 'ELEC 1A'],
            [3, 'Kane', 'Ousmane', 'APP0003', 'M', '2005-05-10', 'Bamako', 'Électronique & Informatique', 'ELEC 2A'],
            [4, 'Bah', 'Aïssatou', 'APP0004', 'F', '2004-12-05', 'Lomé', 'Génie Civil', 'GC 1A'],
            [5, 'Sow', 'Mamadou', 'APP0005', 'M', '2005-07-22', 'Kinshasa', 'Génie Civil', 'GC 1A'],
            [6, 'Cissé', 'Nicole', 'APP0006', 'F', '2005-02-14', 'Abidjan', 'Mécanique Générale', 'MECA 1A'],
            [7, 'Barry', 'Habib', 'APP0007', 'M', '2004-09-08', 'Niamey', 'Électronique & Informatique', 'ELEC 3A'],
            [8, 'Diop', 'Coumba', 'APP0008', 'F', '2005-04-18', 'Saint-Louis', 'Gestion Administrative', 'GA 1A'],
            [9, 'Fall', 'Seydou', 'APP0009', 'M', '2005-06-30', 'Thiès', 'Commerce & Marketing', 'GA 2A'],
            [10, 'Koné', 'Abdoulaye', 'APP0010', 'M', '2004-11-12', 'Ouagadougou', 'Génie Civil', 'GC 2A'],
        ];

        foreach ($apprenantData as [$idx, $nom, $prenom, $matricule, $sexe, $dob, $lieu, $filiere_name, $classe_name]) {
            $filiere_id = $filieresMap[$filiere_name];
            $classe_id = $classesMap[$classe_name];
            
            if ($filiere_id && $classe_id) {
                DB::table('apprenants')->insert([
                    'user_id' => $userIds[$idx - 1],
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'matricule' => $matricule,
                    'sexe' => $sexe,
                    'date_naissance' => $dob,
                    'lieu_naissance' => $lieu,
                    'filiere_id' => $filiere_id,
                    'classe_id' => $classe_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Assign apprenant role
        $roleId = DB::table('roles')->where('name', 'apprenant')->value('id');
        if ($roleId) {
            foreach ($userIds as $userId) {
                DB::table('model_has_roles')->insertOrIgnore([
                    'role_id' => $roleId,
                    'model_type' => 'App\\Models\\User',
                    'model_id' => $userId,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clean up apprenants and their users
        $apprenantUserIds = DB::table('apprenants')
            ->whereIn('matricule', ['APP0001', 'APP0002', 'APP0003', 'APP0004', 'APP0005', 'APP0006', 'APP0007', 'APP0008', 'APP0009', 'APP0010'])
            ->pluck('user_id');
        
        DB::table('apprenants')->whereIn('user_id', $apprenantUserIds)->delete();
        DB::table('model_has_roles')->whereIn('model_id', $apprenantUserIds)->delete();
        DB::table('users')->whereIn('id', $apprenantUserIds)->delete();
    }
};
