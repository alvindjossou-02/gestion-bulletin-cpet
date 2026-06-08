<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insert base Filières
        DB::table('filieres')->insertOrIgnore([
            ['nom_filiere' => 'Électronique & Informatique', 'created_at' => now(), 'updated_at' => now()],
            ['nom_filiere' => 'Génie Civil', 'created_at' => now(), 'updated_at' => now()],
            ['nom_filiere' => 'Mécanique Générale', 'created_at' => now(), 'updated_at' => now()],
            ['nom_filiere' => 'Gestion Administrative', 'created_at' => now(), 'updated_at' => now()],
            ['nom_filiere' => 'Commerce & Marketing', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Insert base Classes
        DB::table('classes')->insertOrIgnore([
            ['nom_classe' => 'ELEC 1A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'ELEC 2A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'ELEC 3A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'GC 1A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'GC 2A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'GC 3A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'MECA 1A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'MECA 2A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'GA 1A', 'created_at' => now(), 'updated_at' => now()],
            ['nom_classe' => 'GA 2A', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('filieres')->where('nom_filiere', 'like', '%Électronique%')->delete();
        DB::table('filieres')->where('nom_filiere', 'like', '%Génie%')->delete();
        DB::table('filieres')->where('nom_filiere', 'like', '%Mécanique%')->delete();
        DB::table('filieres')->where('nom_filiere', 'like', '%Gestion%')->delete();
        DB::table('filieres')->where('nom_filiere', 'like', '%Commerce%')->delete();
        
        DB::table('classes')->whereIn('nom_classe', ['ELEC 1A', 'ELEC 2A', 'ELEC 3A', 'GC 1A', 'GC 2A', 'GC 3A', 'MECA 1A', 'MECA 2A', 'GA 1A', 'GA 2A'])->delete();
    }
};

