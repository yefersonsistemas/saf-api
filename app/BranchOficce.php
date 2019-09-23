<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchOficce extends Model //sucursales
{
    protected $fillable = [ 
        'name', 'length', 'latitude', 'headquarters_id'
    ];

    public function headquarters()
    {
        return $this->belongsTo('App\headquarter');
    }
}
