<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    protected $table = 'medicament';
    public $timestamps = false;
    protected $primaryKey = 'id_medicament';
    protected $fillable = ['id_medicament', 'id_famille', 'depot_legal', 'nom_commercial', 'effets', 'contre_indication', 'prix_echantillon'];

    public function composants(){
        return $this->belongsToMany('App\Models\Composant', 'App\Models\Constituer', 'id_medicament','id_composant')->withPivot('qte_composant');
    }

    public function famille(){
        return $this->belongsTo('App\Models\Famille', 'id_famille', 'id_famille');
    }

    public function listComp(){
        $allreadyComp = [];

        foreach($this->composants as $composant){
            $allreadyComp[] = $composant->id_composant;
        }

        return $allreadyComp;
    }
}
