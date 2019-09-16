<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [ //saldo
        'dni', 'name', 'lastname', 'address', 'email', 'phone', 'user_id', 'Branchoffice_id'
    ];

    public function billing()
    {
        return $this->belongsTo('App\Billing');
    }

    public function positions()
    {
        return $this->belongsTo('App\Position');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment');
    }

   /* public function users()
    {
        return $this->belongsTo('App\User');
    }*/

}
