<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Student;
use App\Models\Annee_scolaire;
use App\Models\Matiere;
use App\Models\Evaluation;
use Illuminate\Http\Request;

use App\Models\Periode;

class BulletinController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classe::all();
        $annee = Annee_scolaire::active();
        $periodes = $annee ? $annee->periodes : collect();
        $selected_periode_id = $request->query('periode_id');
        return view('admin.bulletins.index', compact('classes', 'periodes', 'selected_periode_id'));
    }

    public function generate(Request $request, Classe $classe)
    {
        $annee = Annee_scolaire::active();
        if (!$annee) {
            return back()->with('error', 'Aucune année scolaire active.');
        }

        $periode_id = $request->query('periode_id');
        $periode = $periode_id ? Periode::find($periode_id) : null;

        $data = $this->getBulletinsData($classe, $periode, $annee);
        $bulletins = $data['bulletins'];
        $matieres = $data['matieres'];
        $classStats = $data['classStats'];

        return view('admin.bulletins.show', compact('classe', 'bulletins', 'matieres', 'annee', 'periode', 'classStats'));
    }

    public function studentBulletin(Request $request, Classe $classe, Student $student)
    {
        $annee = Annee_scolaire::active();
        if (!$annee) {
            return back()->with('error', 'Aucune année scolaire active.');
        }

        $periode_id = $request->query('periode_id');
        $periode = $periode_id ? Periode::find($periode_id) : null;

        $data = $this->getBulletinsData($classe, $periode, $annee);
        $bulletins = $data['bulletins'];
        $matieres = $data['matieres'];
        $classStats = $data['classStats'];

        // Trouver le bulletin spécifique de l'élève
        $bulletin = collect($bulletins)->where('student.id', $student->id)->first();

        if (!$bulletin) {
            return back()->with('error', 'Aucune donnée disponible pour cet élève.');
        }

        return view('admin.bulletins.student', compact('classe', 'bulletin', 'matieres', 'annee', 'periode', 'classStats'));
    }

    private function getBulletinsData(Classe $classe, $periode = null, $annee = null)
    {
        if (!$annee)
            $annee = Annee_scolaire::active();

        $students = Student::whereHas('inscriptions', function ($q) use ($classe, $annee) {
            $q->where('classe_id', $classe->id)
                ->where('annee_scolaire_id', $annee->id)
                ->where('status', 'inscrite');
        })
            ->orderBy('nom')
            ->orderBy('prenom')
            ->get();

        $matieres = $classe->matieres;

        $query = Evaluation::where('classe_id', $classe->id)
            ->where('statut', 'validee');

        if ($periode) {
            $query->where('periode_id', $periode->id);
        } else {
            $query->whereBetween('date_evaluation', [$annee->date_debut, $annee->date_fin]);
        }

        $evaluations = $query->with(['notes'])->get();
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
                $details_evaluations = [];

                foreach ($matiereEvals as $eval) {
                    $note = $eval->notes->where('student_id', $student->id)->first();
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
                    $studentData['matieres'][$matiere->id] = [
                        'nom' => $matiere->nom,
                        'moyenne' => $moyenne_matiere,
                        'coef' => $matiere->pivot->coefficient,
                        'points' => $moyenne_matiere * $matiere->pivot->coefficient,
                        'evaluations' => $details_evaluations
                    ];
                    $studentData['total_points'] += $moyenne_matiere * $matiere->pivot->coefficient;
                    $studentData['total_coef'] += $matiere->pivot->coefficient;
                } else {
                    $studentData['matieres'][$matiere->id] = [
                        'nom' => $matiere->nom,
                        'moyenne' => null,
                        'coef' => $matiere->pivot->coefficient,
                        'points' => 0,
                        'evaluations' => []
                    ];
                }
            }

            if ($studentData['total_coef'] > 0) {
                $studentData['moyenne_generale'] = $studentData['total_points'] / $studentData['total_coef'];
            }
            $bulletins[] = $studentData;
        }

        // --- RANGEMENT ET CLASSEMENT ---
        usort($bulletins, function ($a, $b) {
            return $b['moyenne_generale'] <=> $a['moyenne_generale'];
        });

        $rank = 0;
        $prev_moyenne = -1;
        $count = 0;
        foreach ($bulletins as $key => &$b) {
            $count++;
            if ($b['moyenne_generale'] != $prev_moyenne) {
                $rank = $count;
            }
            $b['rang'] = $rank;
            $b['is_ex'] = ($key > 0 && $b['moyenne_generale'] == $bulletins[$key - 1]['moyenne_generale']) ||
                ($key < count($bulletins) - 1 && $b['moyenne_generale'] == $bulletins[$key + 1]['moyenne_generale']);
            $prev_moyenne = $b['moyenne_generale'];
        }

        // --- STATS DE CLASSE ---
        $allMoyennes = collect($bulletins)->where('total_coef', '>', 0)->pluck('moyenne_generale');
        $classStats = [
            'moyenne_generale' => $allMoyennes->average() ?? 0,
            'max' => $allMoyennes->max() ?? 0,
            'min' => $allMoyennes->min() ?? 0,
            'total_students' => count($bulletins),
            'passes' => $allMoyennes->filter(fn($m) => $m >= 10)->count(),
        ];

        return [
            'bulletins' => $bulletins,
            'matieres' => $matieres,
            'classStats' => $classStats
        ];
    }
}
