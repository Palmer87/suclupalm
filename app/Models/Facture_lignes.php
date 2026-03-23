<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture_lignes extends Model
{
    protected $fillable = [
        'facture_id',
        'frais_scolaire_id',
        'montant',
    ];
}
