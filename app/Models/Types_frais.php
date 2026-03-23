<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Types_frais extends Model
{
    protected $table = 'types_frais';
    protected $fillable = ['nom', 'description'];
    public function fraisScolaires()
    {
        return $this->hasMany(Frais_Scolaire::class);
    }
}
