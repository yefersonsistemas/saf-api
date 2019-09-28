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

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
