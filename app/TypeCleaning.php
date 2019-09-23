<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCleaning extends Model //tipo de limpieza
{
    protected $fillable = [ //pagos
        'name', 'description', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }
}
