<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'code', 'procedure_id', 'paid_in_bs', 'paid_in_usd', 'dollar_conversion', 'payment_type', 'movement_number', 'receiving_bank', 'observation', 'assistant_id', 'doctor_id', 'patient_id'
    ];

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function assistant()
    {
        return $this->belongsTo('App\User', 'assistant_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
