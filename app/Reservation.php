<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'date', 'description', 'patient_id', 'approved', 'reschedule', 'cancel', 'discontinued', 'person_id', 'schedule_id', 'specialitie_id', 'branch_id', 
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function consultationType()
    {
        return $this->belongsTo('App\ConsultationType');
    }

    public function schedule()
    {
        return $this->belongsTo('App\Schedule','schedule_id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function diagnostic()
    {
        return $this->belongsTo('App\Diagnostic', 'patient_id');
    }
    
    public function assistance()
    {
        return $this->belongsTo('App\Assistance');
    }

    public function cite()
    {
        return $this->hasmany('App\Cite', 'reservation_id');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality', 'specialitie_id');
    }

    public function inputoutput()
    {
        return $this->hasmany('App\InputOutput','person_id');
    }

}
