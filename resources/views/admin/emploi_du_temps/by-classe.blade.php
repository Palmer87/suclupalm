@extends('layouts.app')
@section('title', 'Emploi du temps par classe')
@section('content')
    <div class="breadcrumbs-area">
        <h3>Emploi du temps</h3>
        <ul>
            <li><a href="{{ route('dashboard') }}">Tableau de bord</a></li>
            <li>Par classe</li>
        </ul>
    </div>

    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Emploi du temps par classe</h3>
                </div>
                <div class="dropdown">
                    <a href="{{ route('admin.emploi_du_temps.classe_pdf', $schedules->first()->classe_id ?? 0) }}"
                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                        <i class="fas fa-file-pdf"></i> Télécharger PDF
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>Jour</th>
                            <th>Horaire</th>
                            <th>Matière</th>
                            <th>Enseignant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ ucfirst($schedule->jour->jours ?? '-') }}</td>
                                <td>{{ $schedule->horaire->heure_debut ?? '-' }} - {{ $schedule->horaire->heure_fin ?? '-' }}
                                </td>
                                <td>{{ $schedule->matiere->nom ?? '-' }}</td>
                                <td>{{ $schedule->enseignant->nom ?? '-' }} {{ $schedule->enseignant->prenom ?? '' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucun emploi du temps trouvé pour cette classe.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection