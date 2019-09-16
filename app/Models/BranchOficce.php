<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOficce extends Model //sucursales
{
    protected $fillable = [ //saldo
        'name', 'length', 'latitude'
    ];

    public function headquarters()
    {
        return $this->belongsTo('App\headquarter');
    }
}
