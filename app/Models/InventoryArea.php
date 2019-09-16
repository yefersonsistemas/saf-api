<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryArea extends Model
{
    protected $fillable = [ //inventario de c/dpto
        'quantity_Assigned', 'quantity_Used', 'quantity_Available',  'Type_Area_id', 'Inventory_id', 'Branchoffice_id'
    ];

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }
    
}
