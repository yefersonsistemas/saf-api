<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model //deptos
{
    protected $fillable = [
        'name', 'Type_Area_id', 'Branchoffice_id'
    ];

    public function type_areas()
    {
        return $this->belongsTo('App\TypeArea');
    }

    public function inventory_areas()
    {
        return $this->belongsTo('App\InventoryArea');
    }
}
