<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'apprenant_id',
        'moyenne_generale',
        'rang',
        'appreciation',
        'trimestre',
    ];

    protected $casts = [
        'moyenne_generale' => 'decimal:2',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }
}
