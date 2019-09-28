<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typesurgery extends Model //tipos de cirugias
{
    protected $table = 'type_surgeries';

    protected $fillable = [ 
        'name', 'duration', 'cost',  'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }

    
}
