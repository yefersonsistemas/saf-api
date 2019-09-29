<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Icome extends Model //ingresos de la clinica por medico
{
    protected $table = 'icome';

    protected $fillable = [
        'biiling_id', 'total', 'branch_id'
    ];
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
   
}
