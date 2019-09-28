<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';

    protected $fillable = [ //saldo
        'person_id', 'position_id', 'branch_id'
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

    public function doctor() //clase de doctor en rango de popularidad
    {
        return $this->hasone('App\Doctor');
    }

    public function specialities()
    {
        return $this->belongsToMany('App\Speciality');
    }

    public function schedules()
    {
        return $this->belongsToMany('App\Schedule');
    }

    public function areaassigment()
    {
        return $this->belongsTo('App\AreaAssigment');
    }

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }

}
