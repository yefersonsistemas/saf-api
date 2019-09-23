<?php

namespace App;

use Illuminate\Database\Eloquent\Model; //moneda

class TypeCurrency extends Model
{
    protected $fillable = [ //saldo
        'name', 'branchoffice_id'
    ];

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}
