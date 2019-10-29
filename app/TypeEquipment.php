<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEquipment extends Model //tipo de equipos
{
    protected $table = 'type_equipment';

    protected $fillable = [ //pagos
        'name', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function equipment()
    {
        return $this->hasMany('App\Equipment');
    }
}
