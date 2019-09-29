<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsultationType extends Model  //motivo de la reservacion
{
    protected $table = 'consultation_types';

    protected $fillable = [
        'name', 'description', 'reservation_id', 'branch_id'
    ];

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
