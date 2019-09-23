<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model //facturacion
{
    protected $fillable = [ //saldo
        'procedure_employe_id', 'person_id', 'patient_id', 'type_payment_id', 'type_currency_id', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->hasone('App\Employe');
    }

    public function patients()
    {
        return $this->belongsTo('App\Patient');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment');
    }

    public function procedure()
    {
        return $this->hasmany('App\Procedure');
    }


}
