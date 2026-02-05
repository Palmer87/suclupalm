@extends('layouts.app')

@section('content')
<div class="breadcrumbs-area">
    <h3>Bulletins</h3>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">Accueil</a>
        </li>
        <li>Bulletins</li>
    </ul>
</div>

<div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Sélectionnez une classe pour générer le bulletin</h3>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table display data-table text-nowrap">
                <thead>
                    <tr>
                        <th>Classe</th>
                        <th>Niveau</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classes as $classe)
                    <tr>
                        <td>{{ $classe->nom }}</td>
                        <td>{{ $classe->niveau ? $classe->niveau->nom : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.bulletins.generate', $classe->id) }}" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                <i class="fas fa-file-alt"></i> Générer Bulletin
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
