<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicament;
use App\Models\Famille;
use App\Models\Composant;

class CompositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('composition.index')->with('medicaments', Medicament::all())
                                        ->with('familles', Famille::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $medicament = Medicament::find($id);
        $allreadyComp = [];

        foreach($medicament->composants as $composant){
            $allreadyComp[] = $composant->id_composant;
        }

        return view('composition.create')->with('medicament', $medicament)
                                         ->with('composants', Composant::all())
                                         ->with('allreadyComp', $allreadyComp);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $destination = $request->choixValidation;

        $medicament = Medicament::find($request->id_medicament);

        $composant = Composant::find($request->selectCompo);

        $qte = $request->qte;

        $medicament->composants()->save($composant, ['qte_composant'=>$qte]);

        if($destination == 1){
            return redirect(route('Composition.show', $request->id_medicament));
        }else{
            return redirect(route('Composition.create', $request->id_medicament));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medicaments = Medicament::all();
        $medicament = Medicament::find($id);
        return view('composition.show')->with('allMedicaments', $medicaments)
                                       ->with('medicament', $medicament);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicament = Medicament::find($id);
        $allreadyComp = [];

        foreach($medicament->composants as $composant){
            $allreadyComp[] = $composant->id_composant;
        }

        return view('composition.edit')->with('medicament', $medicament)
                                         ->with('composants', Composant::all())
                                         ->with('allreadyComp', $allreadyComp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medicament = Medicament::find($id);

        $toSave = [];

        foreach($medicament->composants as $composant){
            $idComp = $request->input('nom'.$composant->id_composant);
            $qte = $request->input('qte'.$composant->id_composant);
            $toSave[$idComp] = $qte;
        }

        $medicament->composants()->detach();

        foreach($toSave as $idComp => $qteComp){
            $composant = Composant::find($idComp);
            $medicament->composants()->save($composant,['qte_composant'=>$qteComp]);
        }

        return redirect(route('Composition.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $medicament = Medicament::find($request->id_medicament);
        $composant = Composant::find($id);

        $medicament->composants()->detach($id);

        return redirect(route('Composition.show', $request->id_medicament));
    }
}
