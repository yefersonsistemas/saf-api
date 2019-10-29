<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model //equipo maquinaria
{
    protected $table = 'equipment';

    protected $fillable = [
        'name', 'description', 'type_equipment_id', 'branch_id'
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }

    public function inventory_area()
    {
        return $this->belongsTo('App\InventoryArea');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typeequipment()
    {
        return $this->belongsTo('App\TypeEquipment');
    }
    
    
}
