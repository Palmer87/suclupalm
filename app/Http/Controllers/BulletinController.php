<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Student;
use App\Models\Annee_scolaire;
use App\Models\Matiere;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class BulletinController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('admin.bulletins.index', compact('classes'));
    }

    public function generate(Classe $classe)
    {
        $annee = Annee_scolaire::active();
        if (!$annee) {
            return back()->with('error', 'Aucune année scolaire active.');
        }

        // Récupérer les étudiants inscrits dans la classe pour l'année active
        $students = Student::whereHas('inscriptions', function($q) use ($classe, $annee) {
            $q->where('classe_id', $classe->id)
              ->where('annee_scolaire_id', $annee->id)
              ->where('status', 'inscrite');
        })
        ->orderBy('nom')
        ->orderBy('prenom')
        ->get();

        $matieres = $classe->matieres; // Matieres avec pivot coefficient

        // Charger toutes les évaluations validées pour la classe et l'année
        $evaluations = Evaluation::where('classe_id', $classe->id)
            ->where('statut', 'validee')
            ->whereBetween('date_evaluation', [$annee->date_debut, $annee->date_fin])
            ->with(['notes'])
            ->get();
        
        // Grouper par matière
        $evaluationsByMatiere = $evaluations->groupBy('matiere_id');

        $bulletins = [];

        foreach ($students as $student) {
            $studentData = [
                'student' => $student,
                'matieres' => [],
                'moyenne_generale' => 0,
                'total_coef' => 0,
                'total_points' => 0,
            ];

            foreach ($matieres as $matiere) {
                $matiereEvals = $evaluationsByMatiere->get($matiere->id, collect());
                
                $total_matiere = 0;
                $coef_matiere = 0;

                foreach ($matiereEvals as $eval) {
                    // Trouver la note de l'étudiant
                    $note = $eval->notes->where('student_id', $student->id)->first();
                    
                    if ($note && $note->note !== null) {
                        // Normaliser la note sur 20
                        $noteSur20 = ($note->note / $eval->note_max) * 20;
                        $total_matiere += $noteSur20 * $eval->coefficient;
                        $coef_matiere += $eval->coefficient;
                    }
                }

                if ($coef_matiere > 0) {
                    $moyenne_matiere = $total_matiere / $coef_matiere;
                    $studentData['matieres'][$matiere->id] = [
                        'nom' => $matiere->nom,
                        'moyenne' => $moyenne_matiere,
                        'coef' => $matiere->pivot->coefficient,
                        'points' => $moyenne_matiere * $matiere->pivot->coefficient,
                    ];

                    $studentData['total_points'] += $moyenne_matiere * $matiere->pivot->coefficient;
                    $studentData['total_coef'] += $matiere->pivot->coefficient;
                } else {
                     $studentData['matieres'][$matiere->id] = [
                        'nom' => $matiere->nom,
                        'moyenne' => null,
                        'coef' => $matiere->pivot->coefficient,
                        'points' => 0,
                    ];
                }
            }

            if ($studentData['total_coef'] > 0) {
                $studentData['moyenne_generale'] = $studentData['total_points'] / $studentData['total_coef'];
            }

            $bulletins[] = $studentData;
        }

        return view('admin.bulletins.show', compact('classe', 'bulletins', 'matieres', 'annee'));
    }

    public function studentBulletin(Classe $classe, Student $student)
    {
        $annee = Annee_scolaire::active();
        if (!$annee) {
            return back()->with('error', 'Aucune année scolaire active.');
        }

        $matieres = $classe->matieres; // Matieres avec pivot coefficient

        // Charger toutes les évaluations validées pour la classe et l'année
        // Filtrer les notes pour cet étudiant spécifiquement
        $evaluations = Evaluation::where('classe_id', $classe->id)
            ->where('statut', 'validee')
            ->whereBetween('date_evaluation', [$annee->date_debut, $annee->date_fin])
            ->with(['notes' => function($q) use ($student) {
                $q->where('student_id', $student->id);
            }])
            ->orderBy('date_evaluation')
            ->get();
        
        $evaluationsByMatiere = $evaluations->groupBy('matiere_id');

        $bulletin = [
            'student' => $student,
            'matieres' => [],
            'moyenne_generale' => 0,
            'total_coef' => 0,
            'total_points' => 0,
        ];

        foreach ($matieres as $matiere) {
            $matiereEvals = $evaluationsByMatiere->get($matiere->id, collect());
            
            $total_matiere = 0;
            $coef_matiere = 0;
            $details_evaluations = [];

            foreach ($matiereEvals as $eval) {
                $note = $eval->notes->first(); // Une seule note car filtrée par student_id
                
                if ($note && $note->note !== null) {
                    $noteSur20 = ($note->note / $eval->note_max) * 20;
                    $total_matiere += $noteSur20 * $eval->coefficient;
                    $coef_matiere += $eval->coefficient;

                    $details_evaluations[] = [
                        'libelle' => $eval->libelle ?? $eval->type,
                        'date' => $eval->date_evaluation,
                        'note' => $note->note,
                        'note_max' => $eval->note_max,
                        'coef' => $eval->coefficient,
                        'note_sur_20' => $noteSur20
                    ];
                }
            }

            if ($coef_matiere > 0) {
                $moyenne_matiere = $total_matiere / $coef_matiere;
                $bulletin['matieres'][$matiere->id] = [
                    'nom' => $matiere->nom,
                    'moyenne' => $moyenne_matiere,
                    'coef' => $matiere->pivot->coefficient,
                    'points' => $moyenne_matiere * $matiere->pivot->coefficient,
                    'evaluations' => $details_evaluations
                ];

                $bulletin['total_points'] += $moyenne_matiere * $matiere->pivot->coefficient;
                $bulletin['total_coef'] += $matiere->pivot->coefficient;
            } else {
                 $bulletin['matieres'][$matiere->id] = [
                    'nom' => $matiere->nom,
                    'moyenne' => null,
                    'coef' => $matiere->pivot->coefficient,
                    'points' => 0,
                    'evaluations' => []
                ];
            }
        }

        if ($bulletin['total_coef'] > 0) {
            $bulletin['moyenne_generale'] = $bulletin['total_points'] / $bulletin['total_coef'];
        }

        return view('admin.bulletins.student', compact('classe', 'bulletin', 'matieres', 'annee'));
    }
}
