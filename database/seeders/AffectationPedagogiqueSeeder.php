<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AffectationPedagogiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enseignants = \App\Models\Enseignant::all();
        $matieres = \App\Models\Matiere::all();
        $classes = \App\Models\Classe::all();
        $anneeScolaire = \App\Models\Annee_scolaire::where('status', 'active')->first();

        if (!$anneeScolaire) return;

        foreach ($classes as $classe) {
            // Assigner 3 à 5 matières par classe avec des enseignants différents
            $matieresAleatoires = $matieres->random(rand(3, 5));
            foreach ($matieresAleatoires as $matiere) {
                \App\Models\affectations_pedagogiques::firstOrCreate([
                    'enseignant_id' => $enseignants->random()->id,
                    'matiere_id' => $matiere->id,
                    'classe_id' => $classe->id,
                    'annee_scolaire_id' => $anneeScolaire->id,
                ]);
            }
        }
    }
}
