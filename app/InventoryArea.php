<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryArea extends Model
{
    protected $table = 'inventory_areas';

    protected $fillable = [ //inventario de c/dpto
        'quantity_Assigned', 'quantity_Used', 'quantity_Available',  'area_id', 'inventory_id', 'branch_id'
    ];

    public function area()
    {
        return $this->belongsTo('App\Area');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    
}
