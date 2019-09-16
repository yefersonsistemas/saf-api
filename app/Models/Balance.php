<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [ //saldo
        'total', 'user_id', 'Branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }


}
