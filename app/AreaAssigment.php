<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaAssigment extends Model //area asignada
{
    protected $fillable = [
        'employe_id', 'area_id', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }

}
