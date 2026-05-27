<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ensure existing records have reboublant = false
        DB::table('apprenants')->update(['reboublant' => false]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op: cannot reliably revert which records were updated
    }
};
