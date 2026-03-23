<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'facture_id',
        'montant',
        'date_paiement',
        'mode_paiement',
        'reference',
        'notes',
    ];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
