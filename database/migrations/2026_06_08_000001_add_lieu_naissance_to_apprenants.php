<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('apprenants', function (Blueprint $table) {
            if (!Schema::hasColumn('apprenants', 'lieu_naissance')) {
                $table->string('lieu_naissance')->nullable()->after('date_naissance');
            }
        });
    }

    public function down(): void
    {
        Schema::table('apprenants', function (Blueprint $table) {
            if (Schema::hasColumn('apprenants', 'lieu_naissance')) {
                $table->dropColumn('lieu_naissance');
            }
        });
    }
};
