<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'apprenant_id',
        'date_absence',
        'justifiee',
        'motif',
    ];

    protected $casts = [
        'date_absence' => 'date',
        'justifiee' => 'boolean',
    ];

    public function apprenant()
    {
        return $this->belongsTo(Apprenant::class);
    }
}
