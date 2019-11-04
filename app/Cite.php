<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cite extends Model  //guarda las citas suspendidas y canceladas
{
    protected $table = 'cites';

    protected $fillable = [
        'reservation_id', 'reason', 'branch_id'
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation', 'person_id');
    }
}
