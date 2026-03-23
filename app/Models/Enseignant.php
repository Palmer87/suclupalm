<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $table = 'enseignants';
    protected $primaryKey = 'id';
    public $timestamps = true;//si on utilise les timestamps created_at et updated_at
    protected $fillable = [
        'user_id',
        'nom',
        'prenom',
        'telephone',
        'email',
        'specialite',
        'statut',


    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function affectations()
    {
        return $this->hasMany(affectations_pedagogiques::class, 'enseignant_id');
    }
    public function matieres()
    {
        return $this->hasMany(Matiere::class);
    }
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'enseignant_id');
    }



}
