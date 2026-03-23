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

            <div class="row mg-b-20">
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Période (Optionnel)</label>
                    <select id="periodeSelector" class="select2">
                        <option value="">Année complète</option>
                        @foreach($periodes as $periode)
                            <option value="{{ $periode->id }}" {{ (isset($selected_periode_id) && $selected_periode_id == $periode->id) ? 'selected' : '' }}>
                                {{ $periode->nom }}
                            </option>
                        @endforeach
                    </select>
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
                                    <a href="{{ route('admin.bulletins.generate', $classe->id) }}"
                                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark generate-btn">
                                        <i class="fas fa-file-alt"></i> Générer Bulletin
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selector = document.getElementById('periodeSelector');

                // Event delegation to handle clicks on generate buttons, even after DataTable re-draws
                document.addEventListener('click', function (e) {
                    const btn = e.target.closest('.generate-btn');
                    if (btn) {
                        const periodId = selector.value;
                        let url = new URL(btn.href);
                        if (periodId) {
                            url.searchParams.set('periode_id', periodId);
                        } else {
                            url.searchParams.delete('periode_id');
                        }
                        btn.href = url.toString();
                    }
                });
            });
        </script>
@endsection