<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('action'); // 'create', 'update', 'delete', 'login'
            $table->string('model'); // Nom du modèle: 'Apprenant', 'Note', 'User', etc
            $table->unsignedBigInteger('model_id')->nullable(); // ID du record modifié
            $table->json('old_values')->nullable(); // Anciennes valeurs
            $table->json('new_values')->nullable(); // Nouvelles valeurs
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            
            // Index pour les requêtes fréquentes
            $table->index('user_id');
            $table->index(['model', 'model_id']);
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
