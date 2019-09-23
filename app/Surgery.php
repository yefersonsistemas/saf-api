<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $fillable = [ //saldo
        'date', 'employe_id', 'patient_id', 'area_id', 'type_surgery_id', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typesurgeries()
    {
        return $this->belongsTo('App\TypeSurgery');
    }

}