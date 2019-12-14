<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typesurgery extends Model //tipos de cirugias
{
    protected $table = 'type_surgeries';

    protected $fillable = [ 
        'name', 'duration', 'cost', 'description', 'classification_surgery_id', 'branch_id'
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
        return $this->belongsTo('App\ClassificationSurgery');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    
}
