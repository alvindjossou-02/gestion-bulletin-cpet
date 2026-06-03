<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'apprenant_id',
        'matiere_id',
        'type_evaluation',
        'note',
    ];

    protected $casts = [
        'note' => 'decimal:2',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
