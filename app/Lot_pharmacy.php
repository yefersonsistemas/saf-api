<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot_pharmacy extends Model
{
    protected $table = 'lot_pharmacy';

    protected $fillable = [
        'medicine_pharmacy_id', 'date', 'quantity_total', 'number_lot','date_vence','branch_id'
    ];

    public function medicine_pharmacy()
    {
         return $this->belongsTo('App\Medicine_pharmacy','medicine_pharmacy_id');
    }
}
