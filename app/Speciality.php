<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';

    protected $fillable = [
        'name', 'description', 'branch_id'
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function patients()
    {
        return $this->hasMany('App\Patient');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

    public function employe() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Employe','speciality_employe')
       ->withPivot('employe_id','id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic');
    }
}
