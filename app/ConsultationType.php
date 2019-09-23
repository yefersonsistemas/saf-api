<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationType extends Model  //motivo de la reservacion
{
    protected $fillable = [
        'name', 'description', 'reservation_id', 'branchoffice_id'
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
