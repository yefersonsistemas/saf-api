<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = [ //inventario
        'quantity_Total', 'quantity_Available', 'quantity_Assigned', 'supplie_id', 'equipment_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function supplie()
    {
        return $this->belongsTo('App\Supplie', 'supplie_id');
    }

    public function equipment()
    {
        return $this->belongsTo('App\MachineEquipment','equipment_id');
    }

    public function InventoryArea()
    {
        return $this->belongsTo('App\InventoryArea');
    }
}
