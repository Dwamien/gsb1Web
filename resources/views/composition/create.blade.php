@extends('layouts.main')

@section('content')
<div class="card card-default">
        <div class="card-header nav justify-content-center">
            <h1>Ajouter un composant</h1>
        </div>
        <div class="card-body">
            <div class="panel panel-default">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom commercial</th>
                            <th>Dépôt légal</th>
                            <th>Nom du composant</th>
                            <th>Quantité</th>
                        </tr>
                    </thead>
                    <tboby>
                        @if($medicament->composants->count() >= 1)
                        @foreach($medicament->composants as $composant)
                        <tr>
                            <td class="cache">{{ $medicament->nom_commercial}}</td>
                            <td class="cache">{{ $medicament->depot_legal}}</td>
                            <td>{{ $composant->lib_composant}}</td>
                            <td>{{ $composant->pivot->qte_composant}}</td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>{{ $medicament->nom_commercial}}</td>
                            <td>{{ $medicament->depot_legal}}</td>
                            <td>Ce médicament n'a pas de composant enregistré</td>
                            <td></td>
                        </tr>
                        @endif
                        <tr>
                            <td></td>
                            <td></td>
                            <td>select choix compo</td>
                            <td>input quantité</td>
                        </tr>
                    </tboby>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="row" style="padding-right:15px">

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $(document).ready(function() {
            $('tr:not(:first-child) td.cache').html('');
        });

    </script>
@endsection
