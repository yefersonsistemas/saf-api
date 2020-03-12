<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informesurgery extends Model
{
    protected $table = 'informe_surgery';

    protected $fillable = [ 
        'surgery_id', 'branch_id', 'status', 'fecha_ingreso', 'fecha_culminar'
    ];

    public function surgery()
    {
        return $this->belongsTo('App\Surgery','surgery_id');
    }

    // public function informe()
    // {
    //     return $this->belongsTo('App\Informesurgery');
    // }

}
