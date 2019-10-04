<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'positions';

    protected $fillable = [ //cargo de empleado
        'name', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsToMany('App\Employe');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function typecleaning() 
    {
        return $this->belongsToMany('App\TypeCleaning');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
}
