<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Composant extends Model
{
	protected $table = 'composant';
    public $timestamps = false;
    protected $primaryKey = 'id_composant';
    protected $fillable = ['id_composant', 'code_composant', 'lib_composant'];

    public function medicaments(){
        return $this->belongsToMany('App\Models\Medicament', 'App\Models\Constituer', 'id_composant', 'id_medicament')->withPivot('qte_composant');
    }
}
