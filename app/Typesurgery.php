<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typesurgery extends Model //tipos de cirugias
{
    protected $table = 'type_surgeries';

    protected $fillable = [ 
        'name', 'duration', 'cost', 'description', 'day_hospitalization','classification_surgery_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }
    
    public function classification()
    {
        return $this->belongsTo('App\ClassificationSurgery','classification_surgery_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function procedure() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Procedure','procedure_surgery')
       ->withPivot('procedure_id','id');
    }

    public function equipment() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Equipment','equipment_surgery')
       ->withPivot('equipment_id','id');
    }

    
}
