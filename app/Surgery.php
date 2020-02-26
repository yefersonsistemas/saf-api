<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    protected $table = 'surgeries';
    
    protected $fillable = [                                                 //faltan las relaciones 
        'date', 'employe_id', 'patient_id', 'area_id', 'type_surgery_id', 'branch_id',  'billing_id', 'payment', 'status'    
    ];

    public function medicine_pharmacy() 
    {
        return $this->belongsToMany('App\Medicine_pharmacy','surgery_medicine_pharmacy')
        ->withPivot('medicine_pharmacy_id','id');
    }

    public function file_doctor()
    {
        return $this->morphMany('App\FileDoctor', 'fileable');
    }

    public function file_internista()
    {
        return $this->morphMany('App\FileInternista', 'fileable');
    }

    public function file_anestesiologo()
    {
        return $this->morphMany('App\FileAnestesiologo', 'fileable');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe','employe_id');
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
    
    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function reservation()
    {
        return $this->hasMany('App\Reservation');
    }

    public function informe()
    {
        return $this->hasMany('App\Informesurgey','file_id');
    
    }
    public function billing()
    {
        return $this->belongsToMany('App\billing','billing_id');
    }
    // public function procedure() //relacion  con la tabla m:m 
    // {
    //     return $this->belongsToMany('App\Procedure','procedure_surgery')
    //    ->withPivot('procedure_id','id');
    // }

    // public function hospitalization()
    // {
    //     return $this->belongsTo('App\Hospitalization');
    // }

}