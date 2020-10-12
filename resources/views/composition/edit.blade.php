@extends('layouts.main')

@section('content')
<div class="card card-default">
        <div class="card-header nav justify-content-center">
            <h1>Modifier une composition</h1>
        </div>
        <form action="{{ route('Composition.update', $medicament->id_medicament) }}" method="POST" id="form">
        @csrf
        @method('PUT')
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
                            @foreach($medicament->composants as $composant)
                            <tr name="field">
                                <td class="cache">{{ $medicament->nom_commercial}}</td>
                                <td class="cache">{{ $medicament->depot_legal}}</td>
                                <td>
                                    <select name="nom{{ $composant->id_composant }}" class="select2">
                                        {{-- on affiche d'abord le composant actuel --}}
                                        <option value="{{ $composant->id_composant }}"> {{ $composant->lib_composant }} </option>

                                        {{-- puis uniquement les composants que le médicament ne contient pas --}}
                                        @foreach($composants as $composant2)
                                        @if(!in_array($composant2->id_composant, $allreadyComp))
                                        <option value="{{ $composant2->id_composant }}"> {{ $composant2->lib_composant }} </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="qte{{$composant->id_composant}}" value="{{ $composant->pivot->qte_composant}}" style="width:50px">
                                </td>
                            </tr>
                            @endforeach
                        </tboby>
                    </table>
                </div>
            </div>

            <div class="card-footer"></div>
                <div class="row" style="padding-right:15px">
                    <button type="submit"  class="btn  btn-success pull-right" style="margin-left:20px">
                    Valider
                    </button>
                    <a href="{{ route('Composition.show', $medicament->id_medicament) }}"  class="btn  btn-danger pull-right" style="height:33.07px">
                    Retour
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('tr:not(:first-child) td.cache').html('');
        });

        $(".select2").select2();
    </script>
@endsection
