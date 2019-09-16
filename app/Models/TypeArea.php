<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeArea extends Model
{
    protected $fillable = [ //saldo
        'name', 'description', 'Branchoffice_id'
    ];

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }

}
