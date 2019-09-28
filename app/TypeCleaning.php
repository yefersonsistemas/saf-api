<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCleaning extends Model //tipo de limpieza
{
    protected $table = 'type_cleaning';

    protected $fillable = [ //pagos
        'name', 'description', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
