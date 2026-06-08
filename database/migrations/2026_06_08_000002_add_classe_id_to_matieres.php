<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('matieres', function (Blueprint $table) {
            if (!Schema::hasColumn('matieres', 'classe_id')) {
                $table->foreignId('classe_id')->nullable()->constrained('classes')->cascadeOnDelete()->after('filiere_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('matieres', function (Blueprint $table) {
            if (Schema::hasColumn('matieres', 'classe_id')) {
                $table->dropForeignKeyIfExists(['classe_id']);
                $table->dropColumn('classe_id');
            }
        });
    }
};
