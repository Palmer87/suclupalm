@extends('layouts.app')

@section('content')
<div class="breadcrumbs-area">
    <h3>Bulletins - {{ $classe->nom }}</h3>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">Accueil</a>
        </li>
        <li>
            <a href="{{ route('admin.bulletins.index') }}">Bulletins</a>
        </li>
        <li>{{ $classe->nom }}</li>
    </ul>
</div>

<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Moyennes de la classe : {{ $classe->nom }} ({{ $annee->annee }})</h3>
            </div>
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Imprimer</a>
                    <a class="dropdown-item" href="{{ route('admin.bulletins.index') }}"><i class="fas fa-arrow-left"></i> Retour</a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-nowrap">
                <thead>
                    <tr>
                        <th rowspan="2" class="align-middle">Matricule</th>
                        <th rowspan="2" class="align-middle">Nom & Prénom</th>
                        @foreach($matieres as $matiere)
                            <th class="text-center">{{ $matiere->nom }}</th>
                        @endforeach
                        <th rowspan="2" class="align-middle text-center bg-light font-weight-bold">Moyenne Générale</th>
                    </tr>
                    <tr>
                        @foreach($matieres as $matiere)
                            <th class="text-center small text-muted">Coef: {{ $matiere->pivot->coefficient }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($bulletins as $data)
                        <tr>
                            <td>{{ $data['student']->matricule }}</td>
                            <td>
                                <a href="{{ route('admin.bulletins.student', ['classe' => $classe->id, 'student' => $data['student']->id]) }}" class="text-dark">
                                    <div class="d-flex align-items-center">
                                        @if($data['student']->photo)
                                            <img src="{{ asset('storage/'.$data['student']->photo) }}" alt="student" class="rounded-circle mr-2" style="width: 30px; height: 30px; object-fit: cover;">
                                        @else
                                            <div class="rounded-circle mr-2 bg-light d-flex align-items-center justify-content-center text-secondary" style="width: 30px; height: 30px; font-weight: bold;">
                                                {{ substr($data['student']->prenom, 0, 1) }}{{ substr($data['student']->nom, 0, 1) }}
                                            </div>
                                        @endif
                                        {{ $data['student']->nom }} {{ $data['student']->prenom }}
                                    </div>
                                </a>
                            </td>
                            @foreach($matieres as $matiere)
                                @php
                                    $matData = $data['matieres'][$matiere->id] ?? null;
                                @endphp
                                <td class="text-center">
                                    @if($matData && $matData['moyenne'] !== null)
                                        <span class="font-weight-bold {{ $matData['moyenne'] < 10 ? 'text-danger' : 'text-dark' }}">
                                            {{ number_format($matData['moyenne'], 2) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td class="text-center font-weight-bold bg-light">
                                @if($data['total_coef'] > 0)
                                    <span class="h6 {{ $data['moyenne_generale'] < 10 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($data['moyenne_generale'], 2) }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
