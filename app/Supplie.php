<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplie extends Model //insumos
{
    protected $fillable = [ //pagos
        'name', 'type_supplie_id', 'presentation', 'branchoffice_id'
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }
}
