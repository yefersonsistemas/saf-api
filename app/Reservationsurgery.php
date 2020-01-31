<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservationsurgery extends Model
{

    protected $table = 'reservation_surgery';

    protected $fillable = [
        'reservation_id','surgery_id','branch_id' 
    ];

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
