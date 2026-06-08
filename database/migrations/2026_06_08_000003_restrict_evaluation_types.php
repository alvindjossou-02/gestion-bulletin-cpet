<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Modifier la colonne type_evaluation pour limiter les valeurs
        if (Schema::hasColumn('notes', 'type_evaluation')) {
            DB::statement("ALTER TABLE notes MODIFY type_evaluation ENUM('Devoir', 'Interrogation') NOT NULL");
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('notes', 'type_evaluation')) {
            DB::statement("ALTER TABLE notes MODIFY type_evaluation VARCHAR(255)");
        }
    }
};
