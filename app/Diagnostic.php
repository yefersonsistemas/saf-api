<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $table = 'diagnostics';

    protected $fillable = [
        'patient_id', 'description', 'reason', 'treatment_id', 'indications', 'employe_id', 'branch_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe', 'employe_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

     public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function treatment()
    {
        return $this->belongsTo('App\Treatment');
    }

    public function speciality()
    {
        return $this->belongsTo('App\Speciality');
    }
}
