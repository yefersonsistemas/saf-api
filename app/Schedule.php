<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'day', 'turn', 'quota', 'employe_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->hasMany('App\Employe','employe_id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
