<?php

namespace App;

use Illuminate\Database\Eloquent\Model; //moneda

class TypeCurrency extends Model
{
    protected $fillable = [ //saldo
        'name', 'Branchoffice_id'
    ];
}
