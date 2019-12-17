<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = 'procedures';

    protected $fillable = [
        'name', 'description', 'price', 'speciality_id', 'branch_id'
    ];

    public function person()
    {
       return $this->belongsTo('App\Person');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Employe');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function employe()
    {
        return $this->belongsToMany('App\Employe','procedure_employe')
       ->withPivot('employe_id','id');
    }

    public function billing()
    {
        return $this->belongsToMany('App\Billing','procedure_billing')
       ->withPivot('billing_id','id');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality');
    }

    public function itineraryS() 
    {
        return $this->belongsToMany('App\Surgery','itinerary_surgery_procedure')
       ->withPivot('surgery_id','id');
    }

    public function patient()
    {
        return $this->belongsToMany('App\Patient','patient_procedure')
                    ->withPivot('patient_id','id');
    }
    // public function surgeries() {
    //     return $this->belongsTo('App\TypeSurgery');
    // }

    public function typesurgery()
    {
        return $this->belongsToMany('App\Typesurgery','procedure_surgery')
       ->withPivot('typesurgery_id','id');
    }
}
