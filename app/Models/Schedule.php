<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day', 'quantity', 'user_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
