<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [ //cargo de empleado
        'name', 'comission', 'user_id', 'Branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
}
