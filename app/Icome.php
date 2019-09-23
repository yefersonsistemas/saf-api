<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icome extends Model //ingresos de la clinica por medico
{
    protected $fillable = [
        'biiling_id', 'total', 'branchoffice_id'
    ];
   
}
