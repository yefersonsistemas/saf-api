<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model //facturacion
{
    protected $fillable = [ //saldo
        'process', 'dni', 'name', 'lastname', 'address', 'phone', 'user_id', 'Patient_id', 'Type_Payment_id', 'Type_Currency_id', 'Branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function patients()
    {
        return $this->belongsTo('App\Patient');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment');
    }
}
