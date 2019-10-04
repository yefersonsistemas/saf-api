<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeSupplie extends Model //tipos de insumos
{
    protected $table = 'type_supplies';

    protected $fillable = [ //pagos
        'name', 'description', 'branch_id'
    ];

    public function supplies()
    {
        return $this->hasMany('App\Supplie');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
