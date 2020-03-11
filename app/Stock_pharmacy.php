<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock_pharmacy extends Model
{
    protected $table = 'stock_pharmacy';

    protected $fillable = [
        'medicine_pharmacy_id', 'total','branch_id'
    ];

    public function medicine_pharmacy()
    {
         return $this->belongsTo('App\Medicine_pharmacy','medicine_pharmacy_id');
    }

    public function lot_pharmacy()
    {
         return $this->belongsTo('App\Lot_pharmacy');
    }
}
