@extends('layouts.app')

@section('content')
    <div class="breadcrumbs-area">
        <h3>Frais Scolaires</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">Accueil</a>
            </li>
            <li>Frais Scolaires</li>
        </ul>
    </div>

    <div class="row">
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Ajouter un Frais Scolaire</h3>
                        </div>
                    </div>
                    <form class="new-added-form" method="POST" action="{{ route('frais_scolaires.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12 form-group">
                                <label>Niveau *</label>
                                <select name="niveau_id" class="select2" required>
                                    <option value="" disabled selected>Choisir un niveau</option>
                                    @foreach($niveaux as $niveau)
                                        <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label>Année Scolaire *</label>
                                <select name="annee_scolaire_id" class="select2" required>
                                    <option value="" disabled selected>Choisir une année</option>
                                    @foreach($annees as $annee)
                                        <option value="{{ $annee->id }}" {{ $annee->status == 'actif' ? 'selected' : '' }}>
                                            {{ $annee->annee }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 form-group">
                                <label>Frais d'inscription</label>
                                <input type="number" name="frais_inscription" class="form-control" min="0" step="0.01"
                                    placeholder="Montant inscription">
                            </div>
                            <div class="col-12 form-group">
                                <label>Frais de scolarité</label>
                                <input type="number" name="frais_Scolarité" class="form-control" min="0" step="0.01"
                                    placeholder="Montant scolarité">
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit"
                                    class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Enregistrer</button>
                                <button type="reset"
                                    class="btn-fill-lg bg-blue-dark btn-hover-yellow">Réinitialiser</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Liste des Frais Scolaires</h3>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>Niveau</th>
                                    <th>Année</th>
                                    <th>Frais Inscription</th>
                                    <th>Frais Scolarité</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($frais as $item)
                                    <tr>
                                        <td>{{ $item->niveau->nom ?? '-' }}</td>
                                        <td>{{ $item->anneeScolaire->annee ?? '-' }}</td>
                                        <td>{{ $item->frais_inscription ? number_format($item->frais_inscription, 0, ',', ' ') . ' FCFA' : '-' }}
                                        </td>
                                        <td>{{ $item->frais_Scolarité ? number_format($item->frais_Scolarité, 0, ',', ' ') . ' FCFA' : '-' }}
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <span class="flaticon-more-button-of-three-dots"></span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item"
                                                        href="{{ route('frais_scolaires.edit', $item->id) }}">
                                                        <i class="fas fa-cogs text-dark-pastel-green"></i> Modifier
                                                    </a>
                                                    <form action="{{ route('frais_scolaires.destroy', $item->id) }}"
                                                        method="POST" onsubmit="return confirm('Êtes-vous sûr ?');"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-times text-orange-red"></i> Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection