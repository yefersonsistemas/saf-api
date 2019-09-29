<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaAssigment extends Model //area asignada
{
    protected $table = 'area_assigments';

    protected $fillable = [
        'employe_id', 'area_id', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }

    public function typearea()
    {
        return $this->belongsTo('App\TypeArea');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

}
