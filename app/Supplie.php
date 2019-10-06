<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplie extends Model //insumos
{
    protected $table = 'supplies';

    protected $fillable = [ //pagos
        'name', 'type_supplie_id', 'presentation', 'branch_id'
    ];

    public function inventory()
    {
        return $this->belongsTo('App\Inventory');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function typesupplie()
    {
        return $this->belongsTo('App\TypeSupplie');
    }

    public function InventoryArea()
    {
        return $this->belongsTo('App\InventoryArea');
    }
}

