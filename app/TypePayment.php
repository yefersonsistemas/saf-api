<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    protected $table = 'type_payments';

    protected $fillable = [ //saldo
        'name', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
