<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'nom_classe',
    ];

    public function apprenants()
    {
        return $this->hasMany(Apprenant::class);
    }
}
