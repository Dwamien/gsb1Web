@extends('layouts.main')

@section('content')
<div class="card card-default">
        <div class="card-header nav justify-content-center">
            <h1>Gestion des compositions</h1>
        </div>
        <div class="card-body">
            <div class="row search" style="display:flex">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="searchName">Rechercher par nom : </label>
                        </div>
                        <div class="col-md-8" style="padding-left:0px">
                            <form action="" method="GET" id="validNom">
                                <select name="searchName" id="searchName" style="width:200px" onchange="subIdMed()">
                                        <option value="0">Sélectionner un nom : </option>
                                        @foreach($allMedicaments as $oneMedicament)
                                        <option value="{{ $oneMedicament->id_medicament }}"> {{ $oneMedicament->nom_commercial }} </option>
                                        @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="searchFam">Rechercher par famille : </label>
                            @if($choixIdFam > 0)
                                @if($choixFam->medicaments()->count() > 0)
                                <label for="searchFam" style="padding-top:10px">Sélectionner un médicament : </label>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-8">
                            <form action="{{route('Composition.show', $medicament->id_medicament)}}" method="GET" id="validFam">
                                <select name="searchFam" id="searchFam" style="width:200px" onchange="subIdFam()">
                                    @if($choixIdFam == 0)
                                    <option value="0">Sélectionner une famille : </option>
                                    @else
                                    <option value="{{$choixIdFam}}">{{$choixFam->lib_famille}}</option>
                                    @endif
                                    @foreach($familles as $famille)
                                    <option value="{{ $famille->id_famille }}"> {{ $famille->lib_famille }} </option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="idFam" name="idFam" value="">
                            </form>

                            @if($choixIdFam > 0)
                                @if($choixFam->medicaments()->count() > 0)
                                <form action="" method="GET" id="validNomParFam" style="padding-top:15px">
                                    <select name="searchNameByFam" id="searchNameByFam" style="width:200px" onchange="subIdMedByFam()">
                                        <option value="0">Sélectionner un nom : </option>
                                        @foreach($allMedicaments->where('id_famille', $choixIdFam) as $medicament)
                                        <option value="{{ $medicament->id_medicament }}"> {{ $medicament->nom_commercial }} </option>
                                        @endforeach
                                    </select>
                                </form>
                                @else
                                    <div><i>Il n'y a pas de médicament de cette famille</i></div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nom commercial</th>
                            <th>Dépôt légal</th>
                            <th>Nom du composant</th>
                            @if($medicament->composants->count() >= 1)
                            <th>Quantité</th>
                            @can('admin')
                            <th>Modifier</th>
                            <th>Supprimer</th>
                            @endcan
                            @endif
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
                            @can('admin')
                            <td style="text-align:center">
                                <a class="glyphicon glyphicon-pencil" href="{{ route('Composition.edit', $medicament->id_medicament) }}" data-toggle="tooltip" data-placement="top" title="Modifier"></a>
                            </td>
                            <td style="text-align:center">
                                <a class="glyphicon glyphicon-trash" data-target="#deleteModal" data-toggle="modal" onclick="deleteData({{$composant->id_composant}})" href="#" >
                                </a>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td>{{ $medicament->nom_commercial}}</td>
                            <td>{{ $medicament->depot_legal}}</td>
                            <td>Ce médicament n'a pas de composant enregistré</td>
                        </tr>
                        @endif
                    </tboby>
                    <!-- Modal pour confirmer la suppression -->
                    <div class="modal" id="deleteModal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form id="deleteForm" action="" method="POST">
                                    <input type="hidden" name="id_medicament" value="{{ $medicament->id_medicament }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-header">
                                        <h4 class="modal-title">Attention : la suppression est définitive.</h4>
                                    </div>
                                    <div class="modal-body">
                                        Voulez-vous vraiment supprimer ce composant ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="formSubmit()">Oui</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>

        @can('admin')
        <div class="card-footer">
            <div class="row" style="padding-right:15px">
                <a href="{{ route('Composition.create', $medicament->id_medicament) }}"  class="btn  btn-success pull-right">
                Ajouter un composant
                </a>
            </div>
        </div>
        @endcan

    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">

        $("#searchName").select2( {
        placeholder: "Sélectionner un nom :"
        } );

        $("#searchFam").select2();

        $("#searchNameByFam").select2();

        function subIdMed(){
            var idMed = document.getElementById("searchName").value;
            var uri = "{{ route('Composition.show', 'id') }}";

            if(idMed != 0){
                uri = uri.replace('id', idMed);
                $("#validNom").attr("action", uri);
                $("#validNom").submit();
            }
        };

        function deleteData(id) {
            var uri = "{{ route('Composition.destroy', 'id')}}";
            uri = uri.replace('id',id);
            $("#deleteForm").attr('action', uri);
        };

        function formSubmit()
        {
            $("#deleteForm").submit();
        };

        function subIdFam(){
            var idFam = document.getElementById("searchFam").value;
            $('#idFam').attr('value', idFam);
            $('#validFam').submit();
        };

        function subIdMedByFam(){
            var idMed = document.getElementById("searchNameByFam").value;
            var uri = "{{ route('Composition.show', 'id') }}";

            if(idMed != 0){
                uri = uri.replace('id', idMed);
                $("#validNomParFam").attr("action", uri);
                $("#validNomParFam").submit();
            }
        };

        $(document).ready(function() {
            $('tr:not(:first-child) td.cache').html('');
        });
    </script>
@endsection
