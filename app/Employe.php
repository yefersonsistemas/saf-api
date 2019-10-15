<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $table = 'employes';

    protected $fillable = [ 
        'person_id', 'position_id', 'branch_id'
    ];

    /**
     * Get the avatar image.
     */
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }
    
    public function user()
    {
        return $this->hasOneThrough('App\User','App\Person');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment');
    }

    public function patient()
    {
        return $this->hasMany('App\Patient', 'employe_id');
    }

    public function doctor() //clase de doctor en rango de popularidad
    {
        return $this->belongsTo('App\Doctor');
    }

    public function specialities()
    {
        return $this->belongsToMany('App\Speciality');
    }

    public function schedule()
    {
        return $this->hasMany('App\Schedule');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function areaassigment()
    {
        return $this->belongsTo('App\AreaAssigment');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function typedoctor()
    {
        return $this->belongsTo('App\TypeDoctor');
    } 

    public function procedures() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Procedure','procedure_employe')
       ->withPivot('procedure_id','id');
    }

    public function typecleaning() 
    {
        return $this->belongsToMany('App\TypeCleaning','employe_cleaning')
       ->withPivot('type_cleaning_id','id');
    }

    public function speciality() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Speciality','speciality_employe')
       ->withPivot('speciality_id','id');
    }

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic');
    }
}
