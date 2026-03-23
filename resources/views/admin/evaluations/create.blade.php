@extends('layouts.app')
@section('content')

    <div class="breadcrumbs-area">
        <h3>Créer une évaluation</h3>
        <ul>
            <li>
                <a href="{{ route('admin.evaluations.index') }}">Évaluation</a>
            </li>
            <li>Créer une évaluation</li>
        </ul>
    </div>
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Nouvelle Évaluation</h3>
                </div>
            </div>
            <form class="new-added-form" action="{{ route('admin.evaluations.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Libellé *</label>
                        <input type="text" name="libelle" class="form-control" placeholder="ex: Devoir 1" required>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Classe *</label>
                        <select name="classe_id" class="select2" required>
                            <option value="">Sélectionner</option>
                            @foreach($classes as $classe)
                                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Matière *</label>
                        <select name="matiere_id" class="select2" required>
                            <option value="">Sélectionner</option>
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Période *</label>
                        <select name="periode_id" class="select2" required>
                            <option value="">Sélectionner</option>
                            @foreach($periodes as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->nom }} ({{ $periode->anneeScolaire->annee }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Enseignant *</label>
                        <select name="enseignant_id" class="select2" required>
                            <option value="">Sélectionner</option>
                            @foreach($enseignants as $enseignant)
                                <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Type *</label>
                        <select name="type" class="select2" required>
                            <option value="Devoir">Devoir</option>
                            <option value="Interrogation">Interrogation</option>
                            <option value="Examen">Examen</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date d'évaluation *</label>
                        <input type="date" name="date_evaluation" class="form-control" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-6 form-group">
                        <label>Coefficient *</label>
                        <input type="number" step="0.1" name="coefficient" class="form-control" value="1" required>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-6 form-group">
                        <label>Note Max *</label>
                        <input type="number" name="note_max" class="form-control" value="20" required>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Statut *</label>
                        <select name="statut" class="select2" required>
                            <option value="brouillon">Brouillon</option>
                            <option value="validee">Validée</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Enregistrer</button>
                        <a href="{{ route('admin.evaluations.index') }}"
                            class="btn-fill-lg bg-blue-dark btn-hover-yellow">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection