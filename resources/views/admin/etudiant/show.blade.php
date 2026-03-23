@extends('layouts.app')
@section('title', 'Détails de l\'élève')
@section('content')

    <div class="breadcrumbs-area">
        <h3>Élèves</h3>
        <ul>
            <li><a href="{{ route('dashboard') }}">Accueil</a></li>
            <li><a href="{{ route('admin.etudiant.index') }}">Élèves</a></li>
            <li>Détails</li>
        </ul>
    </div>

    <!-- Student Profile Header -->
    <div class="card height-auto mg-b-20">
        <div class="card-body">
            <div class="single-info-details">
                <div class="item-img">
                    @if($etudiant->photo)
                        <img src="{{ asset('storage/' . $etudiant->photo) }}" alt="{{ $etudiant->prenom }}"
                            style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 4px solid #667eea;">
                    @else
                        <div
                            style="width: 150px; height: 150px; border-radius: 50%; background: #061557ff; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: bold; font-size: 48px; border: 4px solid #e8e8e8;">
                            {{ strtoupper(substr($etudiant->prenom, 0, 1)) }}{{ strtoupper(substr($etudiant->nom, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="item-content">
                    <div class="header-inline item-header">
                        <h3 class="text-dark-medium font-medium">{{ $etudiant->prenom }} {{ $etudiant->nom }}</h3>
                        <div class="header-elements">
                            <ul>
                                <li>
                                    <a href="{{ route('admin.etudiant.documents.index', $etudiant->id) }}"
                                        title="Documents">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.etudiant.edit', $etudiant->id) }}" title="Modifier">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:window.print()" title="Imprimer">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap mt-2" style="gap: 10px;">
                        <span class="badge"
                            style="background-color: #667eea; color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 13px;">
                            <i class="fas fa-id-card mg-r-5"></i> {{ $etudiant->matricule }}
                        </span>
                        @if($etudiant->sexe == 'M')
                            <span class="badge"
                                style="background-color: #4facfe; color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 13px;">
                                <i class="fas fa-male mg-r-5"></i> Masculin
                            </span>
                        @else
                            <span class="badge"
                                style="background-color: #f093fb; color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 13px;">
                                <i class="fas fa-female mg-r-5"></i> Féminin
                            </span>
                        @endif
                        @if($etudiant->status == 'actif')
                            <span class="badge"
                                style="background-color: #28a745; color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 13px;">
                                <i class="fas fa-check-circle mg-r-5"></i> Actif
                            </span>
                        @else
                            <span class="badge"
                                style="background-color: #dc3545; color: #fff; padding: 5px 12px; border-radius: 15px; font-size: 13px;">
                                <i class="fas fa-times-circle mg-r-5"></i> Inactif
                            </span>
                        @endif
                        @if($etudiant->classe)
                            <span class="badge"
                                style="background-color: #ffc107; color: #333; padding: 5px 12px; border-radius: 15px; font-size: 13px;">
                                <i class="fas fa-chalkboard mg-r-5"></i> {{ $etudiant->classe->nom ?? '' }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Tabs -->
    <div class="row gutters-20">

        <!-- Personal Information -->
        <div class="col-12 col-xl-6">
            <div class="card height-auto mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-user text-dark-pastel-green mg-r-10"></i>Informations personnelles</h3>
                        </div>
                    </div>
                    <div class="info-table table-responsive mt-3">
                        <table class="table text-nowrap">
                            <tbody>
                                <tr>
                                    <td style="width: 180px; color: #6c757d;"><i class="fas fa-user mg-r-8"></i>Nom complet
                                    </td>
                                    <td class="font-medium text-dark-medium">{{ $etudiant->nom }} {{ $etudiant->prenom }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-id-badge mg-r-8"></i>Matricule</td>
                                    <td class="font-medium text-dark-medium"
                                        style="font-family: monospace; color: #667eea;">{{ $etudiant->matricule }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-venus-mars mg-r-8"></i>Sexe</td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $etudiant->sexe == 'M' ? 'Masculin' : 'Féminin' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-birthday-cake mg-r-8"></i>Date de naissance
                                    </td>
                                    <td class="font-medium text-dark-medium">
                                        {{ $etudiant->date_naissance ? \Carbon\Carbon::parse($etudiant->date_naissance)->format('d/m/Y') : '-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-envelope mg-r-8"></i>E-mail</td>
                                    <td class="font-medium text-dark-medium">{{ $etudiant->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-phone mg-r-8"></i>Téléphone</td>
                                    <td class="font-medium text-dark-medium">{{ $etudiant->phone ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-map-marker-alt mg-r-8"></i>Adresse</td>
                                    <td class="font-medium text-dark-medium">{{ $etudiant->address ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #6c757d;"><i class="fas fa-calendar-plus mg-r-8"></i>Date
                                        d'inscription</td>
                                    <td class="font-medium text-dark-medium">{{ $etudiant->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parents -->
        <div class="col-12 col-xl-6">
            <div class="card height-auto mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-users text-orange-peel mg-r-10"></i>Parents / Tuteurs</h3>
                        </div>
                    </div>
                    <div class="mt-3">
                        @forelse($etudiant->parents as $parent)
                            <div class="d-flex align-items-center p-3 mb-2"
                                style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea;">
                                <div
                                    style="width: 45px; height: 45px; border-radius: 50%; background:    #061557ff; display: flex; align-items: center; justify-content: center; color: #fff; font-weight: bold; font-size: 16px; margin-right: 15px;">
                                    {{ strtoupper(substr($parent->prenom, 0, 1)) }}
                                </div>
                                <div>
                                    <strong>{{ $parent->nom }} {{ $parent->prenom }}</strong>
                                    @if($parent->pivot && $parent->pivot->relation)
                                        <span class="badge ml-2"
                                            style="background-color: #e3f2fd; color: #1976d2; padding: 2px 8px; border-radius: 8px; font-size: 11px;">
                                            {{ $parent->pivot->relation }}
                                        </span>
                                    @endif
                                    <div class="mt-1" style="font-size: 13px; color: #6c757d;">
                                        @if($parent->phone)
                                            <i class="fas fa-phone mg-r-5"></i>{{ $parent->phone }}
                                        @endif
                                        @if($parent->email)
                                            <span class="mg-l-10"><i class="fas fa-envelope mg-r-5"></i>{{ $parent->email }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-users fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                Aucun parent enregistré
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrollment History -->
    <div class="row gutters-20">
        <div class="col-12">
            <div class="card height-auto mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-history text-blue mg-r-10"></i>Historique des inscriptions</h3>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Année scolaire</th>
                                    <th>Cycle</th>
                                    <th>Niveau</th>
                                    <th>Classe</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($etudiant->inscriptions as $index => $inscription)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $inscription->anneeScolaire->annee ?? '-' }}</strong>
                                        </td>
                                        <td>{{ $inscription->cycle->nom ?? '-' }}</td>
                                        <td>{{ $inscription->niveau->nom ?? '-' }}</td>
                                        <td>
                                            <span class="badge"
                                                style="background-color: #667eea; color: #fff; padding: 3px 10px; border-radius: 10px;">
                                                {{ $inscription->classe->nom ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($inscription->status == 'actif' || $inscription->status == null)
                                                <span class="badge"
                                                    style="background-color: #28a745; color: #fff; padding: 3px 10px; border-radius: 10px;">
                                                    <i class="fas fa-check"></i> Actif
                                                </span>
                                            @else
                                                <span class="badge"
                                                    style="background-color: #6c757d; color: #fff; padding: 3px 10px; border-radius: 10px;">
                                                    {{ ucfirst($inscription->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="fas fa-clipboard-list fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                            Aucune inscription enregistrée
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

    <!-- Notes -->
    <div class="row gutters-20">
        <div class="col-12">
            <div class="card height-auto mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class="fas fa-chart-bar text-dark-pastel-green mg-r-10"></i>Notes & Évaluations</h3>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Évaluation</th>
                                    <th>Matière</th>
                                    <th>Note</th>
                                    <th>Appréciation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($etudiant->notes as $index => $note)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><strong>{{ $note->evaluation->libelle ?? '-' }}</strong></td>
                                        <td>{{ $note->evaluation->matiere->nom ?? '-' }}</td>
                                        <td>
                                            @php
                                                $noteMax = $note->evaluation->note_max ?? 20;
                                                $percent = $noteMax > 0 ? ($note->note / $noteMax) * 100 : 0;
                                                $color = $percent >= 60 ? '#28a745' : ($percent >= 40 ? '#ffc107' : '#dc3545');
                                            @endphp
                                            <span style="font-weight: 700; color: {{ $color }}; font-size: 15px;">
                                                {{ $note->note }}
                                            </span>
                                            <span style="color: #6c757d; font-size: 12px;">/ {{ $noteMax }}</span>
                                        </td>
                                        <td>{{ $note->appreciation ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-chart-bar fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                            Aucune note enregistrée
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
    <!---FACTURE -->
    <div class="row gutters-20">
        <div class="col-12">
            <div class="card height-auto mg-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3><i class=" text-dark-pastel-green mg-r-10"></i>Facture</h3>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Montant</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($factures as $index => $facture)

                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $facture->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $facture->montant_total }}</td>
                                        <td>{{ $facture->statut }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            <i class="fas fa-file-invoice-dollar fa-2x mb-2 d-block" style="opacity: 0.3;"></i>
                                            Aucune facture enregistrée
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
@endsection