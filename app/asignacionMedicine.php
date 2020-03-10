<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class asignacionMedicine extends Model
{

    protected $table = 'asignacion_medicine';

    protected $fillable = [
        'cantidad', 'lot_pharmacy_id', 'branch_id'
    ];

    public function lot_pharmacy()
    {
        return $this->belongsTo('App\Lot_pharmacy', 'lot_pharmacy_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }
 
    public function surgery() 
    {
        return $this->belongsTo('App\Surgery');
    }

}
