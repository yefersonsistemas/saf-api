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
        return $this->belongsTo('App\Employe');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
