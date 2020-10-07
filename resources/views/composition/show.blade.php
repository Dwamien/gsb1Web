@extends('layouts.main')

@section('content')
<div class="card card-default">
        <div class="card-header nav justify-content-center">
            <h1>Gestion des compositions</h1>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="searchName">Rechercher par nom : </label>
                <select name="searchName" id="searchName" style="width:200px" onchange="recupId()">
                    <option value="0">Sélectionner un nom : </option>
                    @foreach($allMedicaments as $oneMedicament)
                    <option value="{{ $oneMedicament->id_medicament }}"> {{ $oneMedicament->nom_commercial }} </option>
                    @endforeach
                </select>

                <a href="" id="uriGoShow">
                    <button type="button" class="btn btn-default btn-sm" id="btnGoShow" disabled>
                    <span class="glyphicon glyphicon-search"></span>
                    </button>
                </a>
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
                            <th>Modifier</th>
                            <th>Supprimer</th>
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
                            <td style="text-align:center">
                                <a class="glyphicon glyphicon-pencil" href="{{ route('Composition.edit', $composant->id_composant) }}" data-toggle="tooltip" data-placement="top" title="Modifier"></a>
                            </td>
                            <td style="text-align:center">
                                <a class="glyphicon glyphicon-trash" data-target="#deleteModal" data-toggle="modal" onclick="deleteData({{$composant->id_composant}})" href="#" >
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        <!-- Modal pour confirmer la suppression -->
                        <div class="modal" id="deleteModal">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form id="deleteForm" action="" method="POST">
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
                        @else
                        <tr>
                            <td>{{ $medicament->nom_commercial}}</td>
                            <td>{{ $medicament->depot_legal}}</td>
                            <td>Ce médicament n'a pas de composant enregistré</td>
                        </tr>
                        @endif
                    </tboby>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <div class="row" style="padding-right:15px">
                <a href="{{ route('Composition.create', $medicament->id_medicament) }}"  class="btn  btn-success pull-right">
                Ajouter un composant
                </a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $("#searchName").select2( {
        placeholder: "Sélectionner un nom :"
        } );

        function recupId(){
            var recupId = document.getElementById("searchName").value;
            var bt = document.getElementById("btnGoShow");
            var uri = "{{ route('Composition.show', 'id') }}";

            if(recupId != 0){
                bt.disabled = false;
                bt.setAttribute("class", "btn btn-success btn-sm");
                uri = uri.replace('id', recupId);
                $("#uriGoShow").attr("href", uri);
            }else{
                bt.disabled = true;
                bt.setAttribute("class", "btn btn-default btn-sm")
            }

            $("#test").attr("href", recupId);
        };

        function deleteData(id) {
            var uri = "{{ route('Composition.destroy', 'id')}}";
            uri = uri.replace('id',id);
            $("#deleteForm").attr('action', url);
        };

        function formSubmit()
        {
            $("#deleteForm").submit();
        };

        $(document).ready(function() {
            $('tr:not(:first-child) td.cache').html('');
        });
    </script>
@endsection
