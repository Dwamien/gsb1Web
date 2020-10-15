@extends('layouts.main')

@section('content')
@if (session()->has('error'))
    <div class="alert alert-danger">
        {!! session('error') !!}
    </div>
@endif
<div class="card card-default">
        <div class="card-header nav justify-content-center">
            <h1 style="padding-bottom:20px">Ajouter un composant</h1>
        </div>
        <form action="{{ route('Composition.store') }}" method="POST" id="form">
        @csrf
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
                                <td>
                                    <select name="selectCompo" id="selectCompo" style="width:200px" onchange="activBtns()">
                                        <option value="0" id="opt">Sélectionner un composant</option>
                                        @foreach($composants as $composant)
                                            {{-- on affiche uniquement les composants que le médicament ne contient pas --}}
                                            @if(!in_array($composant->id_composant, $allreadyComp))
                                                <option value="{{ $composant->id_composant }}"> {{ $composant->lib_composant }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="qte" placeholder="Indiquer la quantité" style="width:130px; height:27.27px" required>
                                    @error('qte')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        </tboby>
                    </table>
                </div>
            </div>

            <input type="hidden" id="choixValidation" name="choixValidation" value="">
            <input type="hidden" id="id_medicament" name="id_medicament" value="{{$medicament->id_medicament}}">

            <div class="card-footer"></div>
                <div class="row" style="padding-right:15px">
                    <button type="submit"  class="btn  btn-default pull-right" style="margin-left:20px" onclick="formSubmit1()" id="sub1" disabled>
                    Valider et revenir à la page précédente
                    </button>
                    <button type="submit"  class="btn  btn-default pull-right" style="margin-left:20px" onclick="formSubmit2()" id="sub2" disabled>
                    Valider et ajouter un autre composant
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

        $("#selectCompo").select2();

        function formSubmit1(){
            $("#choixValidation").attr("value", 1);
        }

        function formSubmit2(){
            $("#choixValidation").attr("value",2);
        }

        function activBtns(){
            var recupId = document.getElementById("selectCompo").value;
            var bt1 = document.getElementById("sub1");
            var bt2 = document.getElementById("sub2");
            var opt = document.getElementById("select2-selectCompo-container").title;
            if(opt !="Sélectionner un composant"){
                bt1.disabled = false;
                bt2.disabled = false;
                bt1.setAttribute("class", "btn  btn-success pull-right");
                bt2.setAttribute("class", "btn  btn-primary pull-right");
            }else{
                bt1.disabled = true;
                bt2.disabled = true;
                bt1.setAttribute("class", "btn  btn-default pull-right");
                bt2.setAttribute("class", "btn  btn-default pull-right");
            }
        }
    </script>
@endsection
