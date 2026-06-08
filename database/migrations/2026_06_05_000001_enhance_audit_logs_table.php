<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            // Ajouter les colonnes manquantes
            if (!Schema::hasColumn('audit_logs', 'method')) {
                $table->string('method')->nullable()->after('action');
            }
            if (!Schema::hasColumn('audit_logs', 'route')) {
                $table->string('route')->nullable()->after('method');
            }
            if (!Schema::hasColumn('audit_logs', 'url')) {
                $table->text('url')->nullable()->after('route');
            }
            if (!Schema::hasColumn('audit_logs', 'request_data')) {
                $table->json('request_data')->nullable()->after('new_values');
            }
            if (!Schema::hasColumn('audit_logs', 'response_status')) {
                $table->integer('response_status')->nullable()->after('request_data');
            }
            if (!Schema::hasColumn('audit_logs', 'duration')) {
                $table->float('duration')->nullable()->after('response_status');
            }
            if (!Schema::hasColumn('audit_logs', 'user_role')) {
                $table->string('user_role')->nullable()->after('user_id');
            }
            if (!Schema::hasColumn('audit_logs', 'severity')) {
                $table->string('severity')->default('info')->after('duration');
            }
        });
    }

    public function down(): void
    {
        Schema::table('audit_logs', function (Blueprint $table) {
            $columns = [
                'method', 'route', 'url', 'request_data', 'response_status',
                'duration', 'user_role', 'severity'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('audit_logs', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
