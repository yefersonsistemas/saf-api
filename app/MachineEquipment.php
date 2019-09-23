<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineEquipment extends Model //equipo maquinaria
{
    protected $fillable = [
        'name', 'description', 'type_equipment_id', 'branchoffice_id'
    ];

    public function inventory()
    {
        return $this->belongsto('App\Inventory');
    }

    public function inventory_area()
    {
        return $this->belongsto('App\InventoryArea');
    }
}
