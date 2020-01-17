<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model //deptos
{
    protected $table = 'areas';

    protected $fillable = [
        'name', 'status', 'type_area_id', 'branch_id'
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function typearea()
    {
        return $this->hasOne('App\TypeArea');
    }

    public function areaassigment()
    {
        return $this->hasOne('App\AreaAssigment', 'area_id');
    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function inventory()
    {
        return $this->hasMany('App\InventoryArea');
    }

    public function classification()
    {
        return $this->belongsTo('App\Classification');
    }
}
