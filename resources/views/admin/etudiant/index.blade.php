@extends('layouts.app')
@section('title', 'Liste des élèves')
@section('content')

    <div class="breadcrumbs-area">
        <h3>Élèves</h3>
        <ul>
            <li><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li>Liste des élèves</li>
        </ul>
    </div>

    <!-- Summary Cards -->
    <div class="row gutters-20 mg-b-20">
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="dashboard-summery-one" style="border-top: 4px solid #667eea;">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon" style="background: linear-gradient(135deg, #667eea, #764ba2);">
                            <i class="flaticon-classmates text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content text-right">
                            <h6 class="text-uppercase" style="font-size: 11px;">Total élèves</h6>
                            <h2 class="text-dark font-weight-bold">{{ $etudiants->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="dashboard-summery-one" style="border-top: 4px solid #4facfe;">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon" style="background: linear-gradient(135deg, #4facfe, #00f2fe);">
                            <i class="fas fa-male text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content text-right">
                            <h6 class="text-uppercase" style="font-size: 11px;">Garçons</h6>
                            <h2 class="text-dark font-weight-bold">{{ $etudiants->where('sexe', 'M')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="dashboard-summery-one" style="border-top: 4px solid #f093fb;">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon" style="background: linear-gradient(135deg, #f093fb, #f5576c);">
                            <i class="fas fa-female text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content text-right">
                            <h6 class="text-uppercase" style="font-size: 11px;">Filles</h6>
                            <h2 class="text-dark font-weight-bold">{{ $etudiants->where('sexe', 'F')->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-12">
            <div class="dashboard-summery-one" style="border-top: 4px solid #28a745;">
                <div class="row">
                    <div class="col-6">
                        <div class="item-icon" style="background: linear-gradient(135deg, #28a745, #20c997);">
                            <i class="fas fa-chalkboard text-white"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content text-right">
                            <h6 class="text-uppercase" style="font-size: 11px;">Classes uniques</h6>
                            <h2 class="text-dark font-weight-bold">
                                {{ $etudiants->pluck('classe_id')->filter()->unique()->count() }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
<div class="card mg-b-20">
    <div class="card-body py-3">
        <form method="GET" action="{{ route('admin.etudiant.index') }}" class="row gutters-8 align-items-end">
            <div class="col-xl-4 col-lg-4 col-12 form-group mb-0">
                <label style="font-size: 12px; color: #6c757d; font-weight: 600; text-transform: uppercase;">Recherche</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    class="form-control" placeholder="Nom, Prénom ou Matricule...">
            </div>
            <div class="col-xl-3 col-lg-3 col-12 form-group mb-0">
                <label style="font-size: 12px; color: #6c757d; font-weight: 600; text-transform: uppercase;">Sexe</label>
                <select name="sexe" class="form-control">
                    <option value="">Tous</option>
                    <option value="M" {{ request('sexe') == 'M' ? 'selected' : '' }}>Masculin</option>
                    <option value="F" {{ request('sexe') == 'F' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>
            <div class="col-xl-3 col-lg-3 col-12 form-group mb-0">
                <label style="font-size: 12px; color: #6c757d; font-weight: 600; text-transform: uppercase;">Classe</label>
                <select name="classe_id" class="form-control">
                    <option value="">Toutes les classes</option>
                    @foreach($classes as $classe)
                        <option value="{{ $classe->id }}" {{ request('classe_id') == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-xl-2 col-lg-2 col-12 form-group mb-0 d-flex" style="gap: 8px;">
                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark" style="flex: 1;">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('admin.etudiant.index') }}"
                    class="btn-fill-lg bg-blue-dark btn-hover-yellow"
                    style="flex: 1; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>
</div>

    <!-- Table -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Liste des élèves</h3>
                </div>
                <div>
                    <a href="{{ route('admin.etudiant.create') }}"
                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                        <i class="fas fa-plus mg-r-5"></i> Nouvel élève
                    </a>
                </div>
            </div>

            <div class="table-responsive mt-3">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Photo</th>
                            <th>Nom complet</th>
                            <th>Sexe</th>
                            <th>Classe</th>
                            <th>Parents</th>
                            <th>Date de naissance</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($etudiants as $etudiant)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.etudiant.show', $etudiant->id) }}"
                                        style="color: #667eea; font-weight: 600;">
                                        {{ $etudiant->matricule }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if($etudiant->photo)
                                        <img src="{{ asset('storage/' . $etudiant->photo) }}" alt="{{ $etudiant->nom }}"
                                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #e8e8e8;">
                                    @else
                                        <div
                                            style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: inline-flex; align-items: center; justify-content: center; color: #fff; font-weight: bold; font-size: 13px;">
                                            {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->nom, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td><strong>{{ $etudiant->nom }}</strong> {{ $etudiant->prenom }}</td>
                                <td>
                                    @if($etudiant->sexe == 'M')
                                        <span class="badge"
                                            style="background-color: #e3f2fd; color: #1976d2; padding: 3px 10px; border-radius: 10px;">
                                            <i class="fas fa-male mg-r-3"></i> M
                                        </span>
                                    @else
                                        <span class="badge"
                                            style="background-color: #fce4ec; color: #c62828; padding: 3px 10px; border-radius: 10px;">
                                            <i class="fas fa-female mg-r-3"></i> F
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->classe)
                                        <span class="badge"
                                            style="background-color: #e8eaf6; color: #3949ab; padding: 3px 10px; border-radius: 10px;">
                                            {{ $etudiant->classe->nom }}
                                        </span>
                                    @else
                                        <span style="color: #aaa;">Non assigné</span>
                                    @endif
                                </td>
                                <td>
                                    @if($etudiant->parents && $etudiant->parents->count())
                                        @foreach($etudiant->parents as $parent)
                                            <span style="font-size: 13px;">
                                                {{ $parent->nom }} {{ $parent->prenom }}
                                                @if($parent->pivot && $parent->pivot->relation)
                                                    <small style="color: #667eea;">({{ $parent->pivot->relation }})</small>
                                                @endif
                                            </span>
                                            @if(!$loop->last)<br>@endif
                                        @endforeach
                                    @else
                                        <span style="color: #aaa;">-</span>
                                    @endif
                                </td>
                                <td>{{ $etudiant->date_naissance ? \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') : '-' }}
                                </td>
                                <td>{{ $etudiant->phone ?? '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('admin.etudiant.show', $etudiant->id) }}">
                                                <i class="fas fa-eye text-blue mg-r-8"></i>Voir
                                            </a>
                                            <a class="dropdown-item" href="{{ route('admin.etudiant.edit', $etudiant->id) }}">
                                                <i class="fas fa-cogs text-dark-pastel-green mg-r-8"></i>Modifier
                                            </a>
                                            <form action="{{ route('admin.etudiant.destroy', $etudiant->id) }}" method="POST"
                                                style="display: inline;" onsubmit="return confirm('Supprimer cet élève ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fas fa-trash text-orange-red mg-r-8"></i>Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
                                    <i class="flaticon-classmates fa-2x d-block mb-2" style="opacity: 0.3;"></i>
                                    Aucun élève enregistré
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection