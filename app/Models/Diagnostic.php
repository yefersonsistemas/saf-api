<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $fillable = [
        'description', 'reason', 'treatment', 'annex', 'patient_id', 'user_id', 'next_cite'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
