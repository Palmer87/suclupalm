<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Facture;
use App\Models\Inscription;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::with('parents');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%$search%")
                    ->orWhere('prenom', 'like', "%$search%")
                    ->orWhere('matricule', 'like', "%$search%");
            });
        }

        if ($request->filled('sexe')) {
            $query->where('sexe', $request->sexe);
        }
        $classesSearch = Inscription::with('classe')->get();
        if ($request->filled('classe_id')) {
            $query->whereHas('inscriptions', function ($q) use ($request) {
                $q->where('classe_id', $request->classe_id);
            });
        }

        $etudiants = $query->get();

        $classes = \App\Models\Classe::orderBy('nom')->get();

        return view('admin.etudiant.index', compact('etudiants', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = \App\Models\Parents::all();
        return view('admin.etudiant.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        $etudiant = Student::create(
            $request->except('photo', 'parent_id', 'relation')
        );

        // 2️⃣ photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos/etudiants', 'public');
            $etudiant->update(['photo' => $path]);
        }

        // 3️⃣ relation parent
        $etudiant->parents()->attach($request->parent_id, [
            'relation' => $request->relation,
        ]);


        return redirect()->route('admin.etudiant.index')->with('success', 'Eleve ajoute avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ✅ 1️⃣ récupérer l'étudiant existant




        $etudiant = Student::findOrFail($id);

        $inscription = $etudiant->inscriptions()
            ->where('status', 'inscrite')
            ->first();

        $factures = $inscription?->factures ?? collect();

        $etudiant->load([
            'parents',
            'inscriptions.anneeScolaire',
            'inscriptions.cycle',
            'inscriptions.niveau',
            'inscriptions.classe',
            'notes.evaluation.matiere',
        ]);

        return view('admin.etudiant.show', compact('etudiant', 'factures'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etudiant = Student::findOrFail($id);
        $parents = \App\Models\Parents::all();
        return view('admin.etudiant.edit', compact('etudiant', 'parents'));
    }

    public function update(StudentRequest $request, string $id)
    {

        // ✅ 1️⃣ récupérer l'étudiant existant
        $etudiant = Student::findOrFail($id);

        // ✅ 2️⃣ mise à jour des champs
        $etudiant->update(
            $request->except('photo', 'parent_id', 'relation')
        );

        // ✅ 3️⃣ mise à jour de la photo
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos/etudiants', 'public');
            $etudiant->update(['photo' => $path]);
        }

        // ✅ 4️⃣ mise à jour relation parent
        $etudiant->parents()->sync([
            $request->parent_id => [
                'relation' => $request->relation,
            ],
        ]);

        return redirect()
            ->route('admin.etudiant.index')
            ->with('success', 'Élève modifié avec succès');
    }

    /**
     * Display a listing of the resource.
     */
    public function affectation()
    {
        return view('admin.etudiant.affectation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function affect(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:students,id',
            'classe_id' => 'required|exists:classes,id',
        ]);

        // Update student promotion logic to handle cycle_id, niveau_id, and annee_scolaire_id
        Student::whereIn('id', $request->ids)->update([
            'classe_id' => $request->classe_id,
            'cycle_id' => $request->cycle_id,
            'niveau_id' => $request->niveau_id,
            'annee_scolaire_id' => $request->annee_scolaire_id,
        ]);

        return redirect()->route('admin.etudiant.index')->with('success', 'Eleves promus avec succes');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Student::findOrFail($id);
        $etudiant->delete();

        return redirect()->route('admin.etudiant.index')->with('success', 'Eleve supprime avec succes');
    }
}
