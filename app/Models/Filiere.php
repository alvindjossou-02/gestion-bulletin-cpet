<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Filiere extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom_filiere',
    ];

    public function apprenants()
    {
        return $this->hasMany(Apprenant::class);
    }

    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }

    public function classes(): HasManyThrough
    {
        // Récupère les classes liées via les apprenants
        return $this->hasManyThrough(Classe::class, Apprenant::class, 'filiere_id', 'id', 'id', 'classe_id');
    }
}
