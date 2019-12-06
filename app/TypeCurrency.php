<?php

namespace App;

use Illuminate\Database\Eloquent\Model; //moneda

class TypeCurrency extends Model
{
    protected $table = 'type_currencies';

    protected $fillable = [ //saldo
        'name', 'branch_id'
    ];

    public function payment()
    {
        return $this->belongsTo('App\Payment');
    }

    public function billing()
    {
        return $this->belongsTo('App\Billing', 'type_currency');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
