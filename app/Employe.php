<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [ //saldo
        'person_id', 'position_id', 'branchoffice_id'
    ];

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function positions()
    {
        return $this->hasone('App\Position');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment');
    }

    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }

    public function doctor()
    {
        return $this->hasone('App\Doctor');
    }

}
