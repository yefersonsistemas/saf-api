<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model //deptos
{
    protected $table = 'areas';

    protected $fillable = [
        'name', 'type_area_id', 'branch_id'
    ];

    public function type_areas()
    {
        return $this->belongsTo('App\TypeArea');
    }

    public function areaassigment()
    {
        return $this->belongsTo('App\AreaAssigment');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
