<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model //facturacion
{
    protected $table = 'billings';

    protected $fillable = [ //saldo
        'person_id', 'patient_id', 'employe_id', 'type_payment_id', 'type_currency_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Person', 'patient_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function procedure() //relacion con la tabla m:m 
    {
        return $this->belongsToMany('App\Procedure','procedure_billing')
        ->withPivot('procedure_id','id');
    }

    public function person()
    {
        return $this->belongsTo('App\Person', 'person_id');
    }

    public function typepayment()
    {
        return $this->belongsTo('App\TypePayment', 'type_payment_id');
    }

    public function typecurrency()
    {
        return $this->belongsTo('App\TypeCurrency', 'type_currency');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
