<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEquipment extends Model //tipo de equipos
{
    protected $fillable = [ //pagos
        'name', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\MachineEquipment');
    }
}
