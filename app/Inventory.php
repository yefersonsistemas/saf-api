<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventories';

    protected $fillable = [ //inventario
        'quantity_Total', 'quantity_Available', 'quantity_Assigned', 'supplie_id', 'machine_equipment_id', 'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
