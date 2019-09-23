<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryArea extends Model
{
    protected $fillable = [ //inventario de c/dpto
        'quantity_Assigned', 'quantity_Used', 'quantity_Available',  'type_area_id', 'inventory_id', 'branchoffice_id'
    ];

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }
    
}
