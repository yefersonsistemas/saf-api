<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model //facturacion
{
    protected $table = 'billings';

    protected $fillable = [ //saldo
        'procedure_employe_id', 'person_id', 'patient_id', 'employe_id', 'type_payment_id', 'type_currency_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe', 'person_id');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment');
    }

    public function procedures() //relacion con la tabla m:m 
    {
        return $this->belongsToMany('App\Procedure','procedure_billing')
        ->withPivot('procedure_id','id');
    }

    public function person()
    {
        return $this->hasMany('App\Person');
    }

    public function typepaymnets()
    {
        return $this->hasmany('App\TypePayments');
    }

    public function typecurrency()
    {
        return $this->hasmany('App\TypeCurrency');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
