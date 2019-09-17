<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [ //inventario
        'quantity_Total', 'quantity_Available', 'quantity_Assigned', 'Type_Product_id', 'Branchoffice_id'
    ];
}
