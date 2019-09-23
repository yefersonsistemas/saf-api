<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [ //saldo
        'employe_id', 'total', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }


}
