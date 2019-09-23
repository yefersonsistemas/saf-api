<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeSupplie extends Model //tipos de insumos
{
    protected $fillable = [ //pagos
        'name', 'description', 'branchoffice_id'
    ];

    public function supplie()
    {
        return $this->belongsTo('App\Supplie');
    }
}
