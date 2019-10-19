<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'date', 'description', 'patient_id', 'status', 'person_id', 'schedule_id', 'branch_id', 
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe', 'person_id');
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
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }


}
