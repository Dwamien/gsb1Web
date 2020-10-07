@extends('layouts.main')

@section('content')
    <div class="card card-default">
        <div class="card-header nav justify-content-center">
            <h1>Gestion des compositions</h1>
        </div>

        <div class="card-body">
            <div class="row" style="display:flex">
                <div class="form-group">
                    <label for="searchName">Rechercher par nom : </label>
                    <select name="searchName" id="searchName" style="width:200px" onchange="recupId()">
                        <option value="0">Sélectionner un nom : </option>
                        @foreach($medicaments as $medicament)
                        <option value="{{ $medicament->id_medicament }}"> {{ $medicament->nom_commercial }} </option>
                        @endforeach
                    </select>

                    <a href="" id="uriGoShow">
                        <button type="button" class="btn btn-default btn-sm" id="btnGoShow" disabled>
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </a>
                </div>

                <div class="form-group">
                    <label for="searchFam">Rechercher par famille : </label>
                    <select name="searchFam" id="searchFam" style="width:200px" onchange="recupId()">
                        <option value="0">Sélectionner une famille : </option>
                        @foreach($familles as $famille)
                        <option value="{{ $famille->id_famille }}"> {{ $famille->lib_famille }} </option>
                        @endforeach
                    </select>

                    <a href="" id="uriGoShow">
                        <button type="button" class="btn btn-default btn-sm" id="btnGoShow" disabled>
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </a>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="row">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $("#searchName").select2();

        $("#searchFam").select2();

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
        }
    </script>
@endsection
