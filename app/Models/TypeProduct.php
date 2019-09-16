<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    protected $fillable = [ //saldo
        'name', 'description', 'Branchoffice_id'
    ];

    public function inventories()
    {
        return $this->belongsTo('App\Inventory');
    }

    public function inventory_areas()
    {
        return $this->belongsTo('App\InventoryArea');
    }

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }
}
