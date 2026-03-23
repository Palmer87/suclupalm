@extends('layouts.app')
@section('content')

    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Paramètres Scolaires</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">Tableau de bord</a>
            </li>
            <li>Paramètres Scolaires</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Summary Cards Start -->
    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-green">
                            <i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Années Scolaires</div>
                            <div class="item-number"><span class="counter" data-num="{{ $anneesCount }}">{{ $anneesCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue">
                            <i class="flaticon-books text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Cycles</div>
                            <div class="item-number"><span class="counter" data-num="{{ $cyclesCount }}">{{ $cyclesCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-couple text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Niveaux</div>
                            <div class="item-number"><span class="counter" data-num="{{ $niveauxCount }}">{{ $niveauxCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-classmates text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Classes</div>
                            <div class="item-number"><span class="counter" data-num="{{ $classesCount }}">{{ $classesCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-green">
                            <i class="flaticon-technological text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Matières</div>
                            <div class="item-number"><span class="counter" data-num="{{ $matieresCount }}">{{ $matieresCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue">
                            <i class="flaticon-script text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">  Frais</div>
                            <div class="item-number"><span class="counter" data-num="{{ $typesFraisCount??0 }}">{{ $typesFraisCount??0 }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-multiple-users-silhouette text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Enseignants</div>
                            <div class="item-number"><span class="counter" data-num="{{ $enseignantsCount }}">{{ $enseignantsCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-user text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Utilisateurs</div>
                            <div class="item-number"><span class="counter" data-num="{{ $usersCount }}">{{ $usersCount }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Summary Cards End -->

    <!-- Quick Access & Active Year Section -->
    <div class="row gutters-20">

        <!-- Année Scolaire Active -->
        <div class="col-xl-6 col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-calendar-alt text-dark-pastel-green mg-r-10"></i>Année Scolaire Active</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.annee.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-list"></i> Voir toutes
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        @if($anneeActive)
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th style="width: 40%;">Libellé</th>
                                        <td><strong>{{ $anneeActive->annee }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Date de début</th>
                                        <td>{{ \Carbon\Carbon::parse($anneeActive->date_debut)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date de fin</th>
                                        <td>{{ \Carbon\Carbon::parse($anneeActive->date_fin)->format('d/m/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Statut</th>
                                        <td><span class="badge badge-success" style="background-color: #28a745; padding: 5px 12px; border-radius: 12px;">Active</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Aucune année scolaire active.
                                <a href="{{ route('admin.annee.create') }}" class="alert-link">Créer une année scolaire</a>.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Accès Rapide -->
        <div class="col-xl-6 col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-cogs text-orange-peel mg-r-10"></i>Accès Rapide</h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.annee.index') }}" class="btn btn-lg btn-block text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 10px; padding: 15px;">
                                <i class="fas fa-calendar-alt fa-2x mb-2 d-block"></i>
                                Années Scolaires
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.cycle.index') }}" class="btn btn-lg btn-block text-white" style="background:  #861d2bff ; border: none; border-radius: 10px; padding: 15px;">
                                <i class="fas fa-layer-group fa-2x mb-2 d-block"></i>
                                Cycles
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.niveau.index') }}" class="btn btn-lg btn-block text-white" style="background:  #182c86ff ; border: none; border-radius: 10px; padding: 15px;">
                                <i class="fas fa-sort-amount-up fa-2x mb-2 d-block"></i>
                                Niveaux
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.classe.index') }}" class="btn btn-lg btn-block text-white" style="background: #0d4921ff ; border: none; border-radius: 10px; padding: 15px;">
                                <i class="fas fa-door-open fa-2x mb-2 d-block"></i>
                                Classes
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.matiere.index') }}" class="btn btn-lg btn-block text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none; border-radius: 10px; padding: 15px;">
                                <i class="fas fa-book fa-2x mb-2 d-block"></i>
                                Matières
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('frais_scolaires.index') }}" class="btn btn-lg btn-block text-white" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); border: none; border-radius: 10px; padding: 15px;">
                                <i class="fas fa-money-bill-wave fa-2x mb-2 d-block"></i>
                                Frais Scolaires
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Tables Section -->
    <div class="row gutters-20">

        <!-- Cycles Table -->
        <div class="col-xl-6 col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-layer-group text-blue mg-r-10"></i>Cycles</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.cycle.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Niveaux</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cycles as $index => $cycle)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $cycle->nom }}</td>
                                        <td><span class="badge badge-info" style="background-color: #17a2b8; padding: 3px 8px; border-radius: 10px;">{{ $cycle->niveaux_count }}</span></td>
                                        <td>
                                            <a href="{{ route('admin.cycle.edit', $cycle->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Aucun cycle enregistré</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Niveaux Table -->
        <div class="col-xl-6 col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-sort-amount-up text-orange mg-r-10"></i>Niveaux</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.niveau.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Cycle</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($niveaux as $index => $niveau)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $niveau->nom }}</td>
                                        <td>{{ $niveau->cycle->nom ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.niveau.edit', $niveau->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Aucun niveau enregistré</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row gutters-20">

        <!-- Classes Table -->
        <div class="col-xl-6 col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-door-open text-green mg-r-10"></i>Classes</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.classe.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Niveau</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classes as $index => $classe)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $classe->nom }}</td>
                                        <td>{{ $classe->niveau->nom ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.classe.edit', $classe->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Aucune classe enregistrée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Matières Table -->
        <div class="col-xl-6 col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-book text-red mg-r-10"></i>Matières</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.matiere.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Code</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($matieres as $index => $matiere)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $matiere->nom }}</td>
                                        <td>{{ $matiere->code ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('admin.matiere.edit', $matiere->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Aucune matière enregistrée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Années Scolaires Table -->
    <div class="row gutters-20">
        <div class="col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-calendar-alt text-dark-pastel-green mg-r-10"></i>Toutes les Années Scolaires</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.annee.create') }}" class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i> Ajouter
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Année</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($annees as $index => $annee)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $annee->annee }}</td>
                                        <td>{{ \Carbon\Carbon::parse($annee->date_debut)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($annee->date_fin)->format('d/m/Y') }}</td>
                                        <td>
                                            @if($annee->status == 'actif')
                                                <span class="badge badge-success" style="background-color: #28a745; padding: 4px 10px; border-radius: 12px;">Active</span>
                                            @else
                                                <span class="badge badge-secondary" style="background-color: #6c757d; padding: 4px 10px; border-radius: 12px;">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.annee.edit', $annee->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if($annee->status != 'actif')
                                                <form action="{{ route('admin.annee.activate', $annee->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-warning" title="Activer" onclick="return confirm('Activer cette année scolaire ?')">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Aucune année scolaire enregistrée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection