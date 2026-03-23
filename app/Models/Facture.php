<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    protected $fillable = [
        'inscription_id',
        'montant_total',
        'reste',
        'statut',
        'date_echeance',
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }

    public function lines()
    {
        return $this->hasMany(Facture_lignes::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function updateStatus()
    {
        $totalPaid = $this->payments()->sum('montant');
        $this->reste = $this->montant_total - $totalPaid;
        $this->statut = $this->reste <= 0 ? 'soldé' : 'non soldé';
        $this->save();
    }
}
