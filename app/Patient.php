<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'date', 'history_number', 'reason', 'person_id', 'gender', 'place', 'birthdate', 'age','weight',  'occupation', 'profession', 'another_phone', 'previous_surgery', 'employe_id', 'branch_id', 'another_email',
    ];

    public function file()
    {
        return $this->morphOne('App\File', 'fileable');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function disease()
    {
         return $this->belongsToMany('App\Disease','disease_patient')
                      ->withPivot('disease_id','id');
    }

    public function allergy()
    {
         return $this->belongsToMany('App\Allergy','allergy_patient')
                      ->withPivot('allergy_id','id');
    }

    public function medicine()
    {
         return $this->belongsToMany('App\Medicine','medicine_patient')
                      ->withPivot('medicine_id','id');
    }

    public function surgery()
    {
         return $this->belongsToMany('App\Surgery','patient_surgery')
                      ->withPivot('surgery_id','id');
    }

    public function procedure()
    {
         return $this->belongsToMany('App\Procedure','patient_procedure')
                      ->withPivot('procedure_id','id');
    }

    public function diagnostic()
    {
        return $this->hasMany('App\Diagnostic');
    }
    
    public function allergie()
    {
        return $this->belongsToMany('App\Allergy');
    }

    public function repose()
    {
        return $this->hasOne ('App\Repose', 'patient_id');
    }

    public function reportMedico()
    {
        return $this->hasMany('App\ReportMedico', 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function reference()
    {
        return $this->belongsTo('App\Reference');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function inputoutput()
    {
        return $this->belongsTo('App\InputOutput');
    }

    public function itinerary()
    {
        return $this->belongsTo('App\Itinerary','patient_id');
    }
    /**
     * Scope a query to only include patients by dni.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByDni($query, $dni)
    {
        return $query->when($dni, function($query) use ($dni){
            $query->where('dni', $dni);
        });
    }

    /**
     * Scope a query to only include patients by name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $name)
    {
        return $query->when($name, function ($query) use ($name){
            $query->orWhere('name', 'like', '%' . $name . '%')->orWhere('lastname', 'like', '%' . $name . '%');
        });
    }
}
