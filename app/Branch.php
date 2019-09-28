<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model //sucursales
{
   // protected $table = 'branchs';

    protected $fillable = [ 
        'name', 'length', 'latitude', 'headquarters_id'
    ];

    public function headquarters()
    {
        return $this->belongsTo('App\headquarter');
    }
}
