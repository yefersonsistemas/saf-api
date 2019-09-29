<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $table = 'surgeries';
    
    protected $fillable = [ //saldo
        'date', 'employe_id', 'patient_id', 'area_id', 'type_surgery_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typesurgeries()
    {
        return $this->belongsTo('App\TypeSurgery');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

}