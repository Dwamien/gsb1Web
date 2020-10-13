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
                                        @foreach($medicaments as $medicament)
                                        <option value="{{ $medicament->id_medicament }}"> {{ $medicament->nom_commercial }} </option>
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
                            <form action="{{route('Composition.index')}}" method="GET" id="validFam">
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
                                        @foreach($medicaments->where('id_famille', $choixIdFam) as $medicament)
                                        <option value="{{ $medicament->id_medicament }}"> {{ $medicament->nom_commercial }} </option>
                                        @endforeach
                                    </select>
                                </form>
                                @else
                                    <div style="padding-top:15px"><i>Il n'y a pas de médicament de cette famille</i></div>
                                @endif
                            @endif
                        </div>
                    </div>
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
    </script>

@endsection
