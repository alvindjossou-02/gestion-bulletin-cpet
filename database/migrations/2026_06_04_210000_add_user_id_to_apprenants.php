<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('apprenants', function (Blueprint $table) {
            if (!Schema::hasColumn('apprenants', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('apprenants', function (Blueprint $table) {
            if (Schema::hasColumn('apprenants', 'user_id')) {
                $table->dropColumn('user_id');
            }
        });
    }
};
