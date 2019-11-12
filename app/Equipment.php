<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model //equipo maquinaria
{
    protected $table = 'equipment';

    protected $fillable = [
        'name', 'description', 'quantity', 'type_equipment_id', 'branch_id'
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
    
    public function surgery() 
    {
        return $this->belongsToMany('App\Suregery','equipment_surgery')
       ->withPivot('surgery_id','id');
    }
}
