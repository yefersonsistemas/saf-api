<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model  //guarda el medico que no asiste en el dia a trabajar
{
    protected $table = 'assistance';

    protected $fillable = [
        'employe_id', 'status', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function reservation()
    {
        return $this->belongsTo('App\Reservation', 'person_id');
    }
}
