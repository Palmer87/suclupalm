@extends('layouts.app')
@section('content')

    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Tableau de bord administrateur</h3>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">Accueil</a>
            </li>
            <li>Tableau de bord</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Active Year Banner -->
    @if($anneeActive)
    <div class="alert mg-b-20 sidebar-color" style=" color: #fff; border: none; border-radius: 10px; padding: 15px 20px;">
        <div class="d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <i class="fas fa-calendar-alt mg-r-10"></i>
                <strong>Année scolaire active :</strong> {{ $anneeActive->annee }}
                <span class="mg-l-10" style="opacity: 0.8;">
                    ({{ \Carbon\Carbon::parse($anneeActive->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($anneeActive->date_fin)->format('d/m/Y') }})
                </span>
            </div>
            <span class="badge" style="background-color: rgba(255,255,255,0.25); color: #fff; padding: 5px 15px; border-radius: 20px;">
                <i class="fas fa-check-circle mg-r-5"></i> Active
            </span>
        </div>
    </div>
    @else
    <div class="alert alert-warning mg-b-20" style="border-radius: 10px; background: #0e0949e8; color: #fff; border: none; border-radius: 10px; padding: 15px 20px;">
        <i class="fas fa-exclamation-triangle mg-r-10"></i>
        <strong>Attention :</strong> Aucune année scolaire active.
        <a href="{{ route('admin.annee.create') }}" class="alert-link">Créer une année scolaire</a>.
    </div>
    @endif

    <!-- Financial Summary Cards -->
    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-green">
                            <i class="flaticon-money text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Total Encaissé</div>
                            <div class="item-number"><span>{{ number_format($totalEncasse, 0, ',', ' ') }} FCFA</span></div>
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
                            <i class="flaticon-shopping-basket text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Reste à Percevoir</div>
                            <div class="item-number"><span>{{ number_format($resteAPercevoir, 0, ',', ' ') }} FCFA</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Alerts for Overdue Invoices -->
        @if($overdueInvoices->count() > 0)
        <div class="col-xl-6 col-12">
            <div class="alert alert-danger mg-b-20" style="border-radius: 10px; border: none; padding: 15px 20px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <i class="fas fa-exclamation-circle mg-r-10"></i>
                        <strong>Alertes :</strong> {{ $overdueInvoices->count() }} factures en retard !
                    </div>
                    <button type="button" class="btn btn-xs btn-outline-danger" data-toggle="modal" data-target="#overdueModal">
                        Voir les détails
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Dashboard Summary Cards Start Here -->
    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-green">
                            <i class="flaticon-classmates text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Élèves</div>
                            <div class="item-number"><span class="counter" data-num="{{ count($students) }}">{{ count($students) }}</span></div>
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
                            <i class="flaticon-multiple-users-silhouette text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Enseignants</div>
                            <div class="item-number"><span class="counter" data-num="{{ $teachers->count() }}">{{ $teachers->count() }}</span></div>
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
                            <div class="item-title">Parents</div>
                            <div class="item-number"><span class="counter" data-num="{{ count($dashboardParents) }}">{{ count($dashboardParents) }}</span></div>
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
                            <i class="flaticon-books text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Classes</div>
                            <div class="item-number"><span class="counter" data-num="{{ count($dashboardClasses) }}">{{ count($dashboardClasses) }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row of Summary Cards -->
    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-green">
                            <i class="flaticon-shopping-list text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Inscriptions</div>
                            <div class="item-number"><span class="counter" data-num="{{ $inscriptionsCount }}">{{ $inscriptionsCount }}</span></div>
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
                            <i class="flaticon-checklist text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Évaluations</div>
                            <div class="item-number"><span class="counter" data-num="{{ $evaluationsCount }}">{{ $evaluationsCount }}</span></div>
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
                            <i class="flaticon-technological text-orange"></i>
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
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler text-red"></i>
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
    </div>
    <!-- Dashboard Summary Cards End Here -->

    <!-- Charts Row Start Here -->
    <div class="row gutters-20">
        <!-- Students Distribution Chart -->
        <div class="col-12 col-xl-6 col-6-xxxl">
            <div class="card dashboard-card-three pd-b-20 mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Répartition des élèves par sexe</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.etudiant.index') }}"><i
                                        class="fas fa-eye text-dark-pastel-green"></i>Voir tous</a>
                                <a class="dropdown-item" href="{{ route('admin.etudiant.create') }}"><i
                                        class="fas fa-plus text-orange-peel"></i>Ajouter</a>
                            </div>
                        </div>
                    </div>
                    <div class="doughnut-chart-wrap">
                        <canvas id="student-doughnut-chart" width="100" height="300"></canvas>
                    </div>
                    <div class="student-report">
                        <div class="student-count pseudo-bg-blue">
                            <h4 class="item-title">Filles</h4>
                            <div class="item-number"><span class="counter" data-num="{{ $femaleStudents }}">{{ $femaleStudents }}</span></div>
                        </div>
                        <div class="student-count pseudo-bg-yellow">
                            <h4 class="item-title">Garçons</h4>
                            <div class="item-number"><span class="counter" data-num="{{ $maleStudents }}">{{ $maleStudents }}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inscriptions by Cycle Chart -->
        <div class="col-12 col-xl-6 col-6-xxxl">
            <div class="card dashboard-card-one pd-b-20 mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Inscriptions par cycle</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.inscription.index') }}"><i
                                        class="fas fa-eye text-dark-pastel-green"></i>Voir toutes</a>
                                <a class="dropdown-item" href="{{ route('admin.inscription.create') }}"><i
                                        class="fas fa-plus text-orange-peel"></i>Nouvelle inscription</a>
                            </div>
                        </div>
                    </div>
                    <div class="earning-chart-wrap" style="min-height: 300px;">
                        <canvas id="inscriptions-cycle-chart" width="100" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="row gutters-20">

        <!-- Recent Students Table -->
        <div class="col-12 col-xl-6 col-6-xxxl">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Derniers élèves inscrits</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.etudiant.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-list"></i> Voir tous
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Matricule</th>
                                    <th>Nom complet</th>
                                    <th>Sexe</th>
                                    <th>Classe</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentStudents as $student)
                                    <tr>
                                        <td>
                                            @if($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" alt="" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                                            @else
                                                <div style="width: 35px; height: 35px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: bold; font-size: 14px;">
                                                    {{ strtoupper(substr($student->prenom, 0, 1)) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td><span style="font-family: monospace; font-size: 13px; color: #667eea;">{{ $student->matricule }}</span></td>
                                        <td><strong>{{ $student->nom }}</strong> {{ $student->prenom }}</td>
                                        <td>
                                            @if($student->sexe == 'M')
                                                <span class="badge" style="background-color: #4facfe; color: #fff; padding: 3px 10px; border-radius: 10px;">M</span>
                                            @else
                                                <span class="badge" style="background-color: #f093fb; color: #fff; padding: 3px 10px; border-radius: 10px;">F</span>
                                            @endif
                                        </td>
                                        <td>{{ $student->classe->nom ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-user-graduate fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                            Aucun élève inscrit
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Evaluations Table -->
        <div class="col-12 col-xl-6 col-6-xxxl">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Évaluations récentes</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.evaluations.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-list"></i> Voir toutes
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Libellé</th>
                                    <th>Classe</th>
                                    <th>Matière</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentEvaluations as $evaluation)
                                    <tr>
                                        <td><strong>{{ $evaluation->libelle }}</strong></td>
                                        <td>{{ $evaluation->classe->nom ?? '-' }}</td>
                                        <td>{{ $evaluation->matiere->nom ?? '-' }}</td>
                                        <td>
                                            <span class="badge" style="background-color: #e3f2fd; color: #1976d2; padding: 3px 10px; border-radius: 10px;">
                                                {{ ucfirst($evaluation->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($evaluation->statut == 'validee')
                                                <span class="badge" style="background-color: #28a745; color: #fff; padding: 3px 10px; border-radius: 10px;">
                                                    <i class="fas fa-check"></i> Validée
                                                </span>
                                            @else
                                                <span class="badge" style="background-color: #ffc107; color: #333; padding: 3px 10px; border-radius: 10px;">
                                                    <i class="fas fa-clock"></i> En cours
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-clipboard-list fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                            Aucune évaluation
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Distribution per Class & Calendar Row -->
    <div class="row gutters-20">

        <!-- Students per Class Bar Chart -->
        <div class="col-12 col-xl-8 col-6-xxxl">
            <div class="card dashboard-card-two pd-b-20 mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Effectifs par classe</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('admin.classe.index') }}"><i
                                        class="fas fa-eye text-dark-pastel-green"></i>Voir toutes</a>
                            </div>
                        </div>
                    </div>
                    <div class="expense-chart-wrap" style="min-height: 320px;">
                        <canvas id="students-per-class-chart" width="660" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats Panel -->
        <div class="col-12 col-xl-4 col-3-xxxl">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Statistiques rapides</h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        <!-- Evaluations validated vs pending -->
                        <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <div>
                                <div style="font-size: 13px; color: #6c757d;">Évaluations validées</div>
                                <div style="font-size: 22px; font-weight: 700; color: #28a745;">{{ $evaluationsValidees }}</div>
                            </div>
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #43e97b, #38f9d7); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-check-double text-white"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <div>
                                <div style="font-size: 13px; color: #6c757d;">Évaluations en attente</div>
                                <div style="font-size: 22px; font-weight: 700; color: #ffc107;">{{ $evaluationsEnAttente }}</div>
                            </div>
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #f093fb, #f5576c); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-hourglass-half text-white"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <div>
                                <div style="font-size: 13px; color: #6c757d;">Notes saisies</div>
                                <div style="font-size: 22px; font-weight: 700; color: #667eea;">{{ $notesCount }}</div>
                            </div>
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #667eea, #764ba2); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-pen text-white"></i>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3 p-3" style="background: #f8f9fa; border-radius: 10px;">
                            <div>
                                <div style="font-size: 13px; color: #6c757d;">Types de frais</div>
                                <div style="font-size: 22px; font-weight: 700; color: #e91e63;">{{ $typesFraisCount??0 }}</div>
                            </div>
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #fa709a, #fee140); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-money-bill-wave text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Classes Overview Table -->
    <div class="row gutters-20">
        <div class="col-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Aperçu des classes</h3>
                        </div>
                        <div>
                            <a href="{{ route('admin.classe.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt"></i> Gérer les classes
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Classe</th>
                                    <th>Niveau</th>
                                    <th>Effectif</th>
                                    <th>Garçons</th>
                                    <th>Filles</th>
                                    <th>Matières</th>
                                    <th>Progression</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($classesOverview as $classe)
                                    <tr>
                                        <td><strong>{{ $classe->nom }}</strong></td>
                                        <td>{{ $classe->niveau->nom ?? '-' }}</td>
                                        <td>
                                            <span class="badge" style="background-color: #667eea; color: #fff; padding: 4px 12px; border-radius: 12px; font-size: 13px;">
                                                {{ $classe->students_count }}
                                            </span>
                                        </td>
                                        <td>{{ $classe->male_count }}</td>
                                        <td>{{ $classe->female_count }}</td>
                                        <td>{{ $classe->matieres_count }}</td>
                                        <td style="width: 200px;">
                                            @php
                                                $capacity = 50;
                                                $percent = $capacity > 0 ? min(round(($classe->students_count / $capacity) * 100), 100) : 0;
                                                $barColor = $percent > 80 ? '#e74c3c' : ($percent > 50 ? '#f39c12' : '#27ae60');
                                            @endphp
                                            <div style="background: #e9ecef; border-radius: 10px; height: 8px; overflow: hidden;">
                                                <div style="width: {{ $percent }}%; height: 100%; background: {{ $barColor }}; border-radius: 10px; transition: width 0.6s ease;"></div>
                                            </div>
                                            <small class="text-muted">{{ $percent }}% ({{ $classe->students_count }}/{{ $capacity }})</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-school fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                            Aucune classe
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Calendar -->
    <div class="row gutters-20">
        <div class="col-12 col-xl-6">
            <div class="card dashboard-card-four pd-b-20 mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Calendrier</h3>
                        </div>
                    </div>
                    <div class="calender-wrap">
                        <div id="fc-calender" class="fc-calender"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Panel -->
        <div class="col-12 col-xl-6">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Actions rapides</h3>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.etudiant.create') }}" class="btn btn-lg btn-block text-white d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; border-radius: 12px; padding: 18px 15px;">
                                <i class="fas fa-user-plus fa-lg mg-r-15"></i>
                                <span>Nouvel élève</span>
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.inscription.create') }}" class="btn btn-lg btn-block text-white d-flex align-items-center" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none; border-radius: 12px; padding: 18px 15px;">
                                <i class="fas fa-file-signature fa-lg mg-r-15"></i>
                                <span>Inscription</span>
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.evaluations.create') }}" class="btn btn-lg btn-block text-white d-flex align-items-center" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none; border-radius: 12px; padding: 18px 15px;">
                                <i class="fas fa-clipboard-list fa-lg mg-r-15"></i>
                                <span>Évaluation</span>
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.enseignant.create') }}" class="btn btn-lg btn-block text-white d-flex align-items-center" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); border: none; border-radius: 12px; padding: 18px 15px;">
                                <i class="fas fa-chalkboard-teacher fa-lg mg-r-15"></i>
                                <span>Enseignant</span>
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('admin.bulletins.index') }}" class="btn btn-lg btn-block text-white d-flex align-items-center" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none; border-radius: 12px; padding: 18px 15px;">
                                <i class="fas fa-file-alt fa-lg mg-r-15"></i>
                                <span>Bulletins</span>
                            </a>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <a href="{{ route('parametres_scolaires') }}" class="btn btn-lg btn-block text-white d-flex align-items-center" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%); border: none; border-radius: 12px; padding: 18px 15px;">
                                <i class="fas fa-cog fa-lg mg-r-15"></i>
                                <span>Paramètres</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Trends & Overdue Modal Start Here -->
    <div class="row gutters-20">
        <!-- Attendance Trend Chart -->
        <div class="col-12 col-xl-12 col-12-xxxl">
            <div class="card dashboard-card-one pd-b-20 mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Tendance des présences (15 derniers jours)</h3>
                        </div>
                    </div>
                    <div class="earning-chart-wrap" style="min-height: 350px;">
                        <canvas id="attendance-trend-chart" width="100" height="350"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Overdue Invoices -->
    <div class="modal fade" id="overdueModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Factures en retard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Élève</th>
                                    <th>Classe</th>
                                    <th>Échéance</th>
                                    <th>Montant Restant</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($overdueInvoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->inscription->student->nom }} {{ $invoice->inscription->student->prenom }}</td>
                                    <td>{{ $invoice->inscription->classe->nom ?? '-' }}</td>
                                    <td class="text-danger font-bold">{{ \Carbon\Carbon::parse($invoice->date_echeance)->format('d/m/Y') }}</td>
                                    <td>{{ number_format($invoice->reste, 0, ',', ' ') }} FCFA</td>
                                    <td>
                                        <a href="{{ route('admin.inscription.show', $invoice->inscription_id) }}" class="btn btn-xs btn-primary">Détails</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Scripts -->
    <script>
        window.studentStats = {
            female: {{ $femaleStudents }},
            male: {{ $maleStudents }}
        };

        window.inscriptionsByCycle = @json($inscriptionsByCycle);
        window.studentsPerClass = @json($studentsPerClass);
        
        // Data for Attendance Trend
        @php
            $dates = $attendanceTrends->keys()->map(fn($d) => \Carbon\Carbon::parse($d)->format('d/m'))->values();
            $presentData = [];
            $absentData = [];
            foreach($attendanceTrends as $date => $stats) {
                $presentData[] = $stats->where('statut', 'present')->first()->count ?? 0;
                $absentData[] = $stats->where('statut', 'absent')->first()->count ?? 0;
            }
        @endphp
        window.attendanceData = {
            labels: @json($dates),
            present: @json($presentData),
            absent: @json($absentData)
        };
    </script>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // === Inscriptions by Cycle - Doughnut Chart ===
    var cycleCtx = document.getElementById('inscriptions-cycle-chart');
    if (cycleCtx && window.inscriptionsByCycle) {
        var data = window.inscriptionsByCycle;
        var colors = ['#667eea', '#f5576c', '#4facfe', '#43e97b', '#fa709a', '#a18cd1', '#fbc2eb', '#f093fb'];
        new Chart(cycleCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: data.map(function(item) { return item.label; }),
                datasets: [{
                    data: data.map(function(item) { return item.count; }),
                    backgroundColor: colors.slice(0, data.length),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: { padding: 15, usePointStyle: true }
                }
            }
        });
    }

    // === Attendance Trend - Line Chart ===
    var attendanceCtx = document.getElementById('attendance-trend-chart');
    if (attendanceCtx && window.attendanceData) {
        var attData = window.attendanceData;
        new Chart(attendanceCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: attData.labels,
                datasets: [
                    {
                        label: 'Présents',
                        data: attData.present,
                        backgroundColor: 'rgba(67, 233, 123, 0.1)',
                        borderColor: '#2ecc71',
                        borderWidth: 3,
                        pointBackgroundColor: '#2ecc71',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Absents',
                        data: attData.absent,
                        backgroundColor: 'rgba(245, 87, 108, 0.1)',
                        borderColor: '#e74c3c',
                        borderWidth: 3,
                        pointBackgroundColor: '#e74c3c',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { position: 'top' },
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true, stepSize: 1 },
                        gridLines: { color: 'rgba(0,0,0,0.05)' }
                    }],
                    xAxes: [{
                        gridLines: { display: false }
                    }]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                }
            }
        });
    }

    // === Students per Class - Bar Chart ===
    var classCtx = document.getElementById('students-per-class-chart');
    if (classCtx && window.studentsPerClass) {
        var classData = window.studentsPerClass;
        new Chart(classCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: classData.map(function(item) { return item.label; }),
                datasets: [{
                    label: 'Effectif',
                    data: classData.map(function(item) { return item.count; }),
                    backgroundColor: classData.map(function(_, i) {
                        var barColors = [
                            'rgba(102, 126, 234, 0.8)',
                            'rgba(245, 87, 108, 0.8)',
                            'rgba(79, 172, 254, 0.8)',
                            'rgba(67, 233, 123, 0.8)',
                            'rgba(250, 112, 154, 0.8)',
                            'rgba(161, 140, 209, 0.8)',
                            'rgba(251, 194, 235, 0.8)',
                            'rgba(240, 147, 251, 0.8)'
                        ];
                        return barColors[i % barColors.length];
                    }),
                    borderColor: classData.map(function(_, i) {
                        var borderColors = [
                            '#667eea', '#f5576c', '#4facfe', '#43e97b',
                            '#fa709a', '#a18cd1', '#fbc2eb', '#f093fb'
                        ];
                        return borderColors[i % borderColors.length];
                    }),
                    borderWidth: 2,
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: { display: false },
                scales: {
                    yAxes: [{
                        ticks: { beginAtZero: true, stepSize: 5 },
                        gridLines: { color: 'rgba(0,0,0,0.05)' }
                    }],
                    xAxes: [{
                        gridLines: { display: false }
                    }]
                }
            }
        });
    }
});
</script>
@endpush