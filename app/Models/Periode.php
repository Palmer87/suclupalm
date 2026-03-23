<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $fillable = [
        'nom',
        'type',
        'date_debut',
        'date_fin',
        'annee_scolaire_id',
        'status',
    ];

    public function anneeScolaire()
    {
        return $this->belongsTo(Annee_scolaire::class, 'annee_scolaire_id');
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
