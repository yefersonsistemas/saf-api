<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [ //pagos
        'total_withdrawal', 'total', 'user_id', 'user_id', 'Branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
}
