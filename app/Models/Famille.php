<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Famille extends Model
{
    protected $table = 'famille';
    public $timestamps = false;
    protected $primaryKey = 'id_famille';
    protected $fillable = ['id_famille', 'code_famille', 'lib_famille'];

    public function medicaments(){
        return $this->hasMany('App\Models\Medicament', 'id_famille', 'id_famille');
    }
}
