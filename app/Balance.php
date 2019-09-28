<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'balances';

    protected $fillable = [ //saldo
        'employe_id', 'total', 'branch_id'
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
