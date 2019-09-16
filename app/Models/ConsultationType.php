<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationType extends Model
{
    protected $fillable = [
        'name', 'description',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
