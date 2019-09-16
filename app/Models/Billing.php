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
}
