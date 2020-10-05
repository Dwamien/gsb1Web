<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Constituer extends Pivot
{
    protected $table = 'constituer';
    protected $fillable = ['id_composant', 'id_medicament', 'qte_composant'];
}
