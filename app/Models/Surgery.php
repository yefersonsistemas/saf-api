<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $fillable = [ //saldo
        'date', 'user_id', 'Patient_id', 'Area_id', 'Type_Surgery_id', 'Branchoffice_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typesurgeries()
    {
        return $this->belongsTo('App\TypeSurgery');
    }

}