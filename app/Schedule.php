<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'day', 'turn', 'quota', 'employe_id', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe','employe_id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
