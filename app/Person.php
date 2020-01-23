<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'persons';

    protected $fillable = [ //pagos
        'type_dni', 'dni', 'name', 'lastname', 'address', 'phone', 'email', 'branch_id'
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function employe()
    {
        return $this->hasOne('App\Employe');
    }
    
    public function historyPatient()  //relacion con paciente
    {
        return $this->hasOne('App\Patient');
    }

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
    
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

      public function reservation()
    {
        return $this->hasMany('App\Reservation');
    }

    public function reservationPatient()
    {
        return $this->hasMany('App\Reservation', 'patient_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    public function notification()
    {
        return $this->belongsTo('App\Notification');
    }

    public function inputoutput()
    {
        return $this->hasmany('App\InputOutput');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    
    public function itinerary()
    {
        return $this->belongsTo('App\Itinerary', 'patient_id');
    }
}
