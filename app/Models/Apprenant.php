<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apprenant extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom',
        'prenom',
        'matricule',
        'sexe',
        'date_naissance',
        'filiere_id',
        'classe_id',
        'reboublant',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'reboublant' => 'boolean',
    ];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function bulletins()
    {
        return $this->hasMany(Bulletin::class);
    }

    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}
