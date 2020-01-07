<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //importamos

class Cite extends Model  //guarda las citas suspendidas y canceladas
{
    use SoftDeletes; //Implementamos

    protected $dates = ['deleted_at']; //Registramos la nueva columna
    protected $table = 'cites';

    protected $fillable = [
        'reservation_id', 'reason', 'branch_id'
    ];

    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }
}
