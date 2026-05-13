<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;

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
}
