<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $table = 'surgeries';
    
    protected $fillable = [ 
        'date', 'employe_id', 'patient_id', 'area_id', 'type_surgery_id', 'hospitalization_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typesurgeries()
    {
        return $this->belongsTo('App\Typesurgery', 'type_surgery_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    
    public function equipment() 
    {
        return $this->belongsToMany('App\Equipment','equipment_surgery')
        ->withPivot('equipment_id','id');
    }

    public function itineraryP() 
    {
        return $this->belongsToMany('App\Procedure','itinerary_surgery_procedure')
        ->withPivot('procedure_id','id');
    }

    public function patient()
    {
        return $this->belongsToMany('App\Patient','patient_surgery')
                    ->withPivot('patient_id','id');
    }

    // public function procedure() //relacion  con la tabla m:m 
    // {
    //     return $this->belongsToMany('App\Procedure','procedure_surgery')
    //    ->withPivot('procedure_id','id');
    // }

    public function hospitalization()
    {
        return $this->belongsTo('App\Hospitalization');
    }

}