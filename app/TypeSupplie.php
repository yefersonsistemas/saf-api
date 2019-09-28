<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeSupplie extends Model //tipos de insumos
{
    protected $table = 'type_supplies';

    protected $fillable = [ //pagos
        'name', 'description', 'branch_id'
    ];

    public function supplie()
    {
        return $this->belongsTo('App\Supplie');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
