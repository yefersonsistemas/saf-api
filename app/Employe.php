<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //importamos

class Employe extends Model
{
    use SoftDeletes; //Implementamos 

    protected $dates = ['deleted_at']; //Registramos la nueva columna
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
    
    public function repose()
    {
        return $this->hasMany('App\Repose', 'employe_id');
    }

    public function reportMedico()
    {
        return $this->hasMany('App\ReportMedico', 'employe_id');
    }

    public function user()
    {
        return $this->hasOneThrough('App\User','App\Person');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function inputoutput()
    {
        return $this->belongsTo('App\InputOutput');
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
        return $this->hasOne('App\AreaAssigment', 'employe_id');
    }
    
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    
    // public function reference()
    // {
    //     return $this->belongsTo('App\Reference');
    // }

    public function typedoctor()
    {
        return $this->belongsTo('App\TypeDoctor');
    } 
    
    public function doctor() //clase de doctor en rango de popularidad
    {
        return $this->hasOne('App\Doctor', 'employe_id');
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

    public function assistance()
    {
        return $this->hasmany('App\Assistance', 'employe_id');
    }    

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    } 
}
