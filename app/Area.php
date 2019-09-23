<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model //deptos
{
    protected $fillable = [
        'name', 'type_area_id', 'branchoffice_id'
    ];

    public function type_areas()
    {
        return $this->belongsTo('App\TypeArea');
    }
}
