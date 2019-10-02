<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCleaning extends Model //tipo de limpieza
{
    protected $table = 'type_cleaning';

    protected $fillable = [ //pagos
        'name', 'description', 'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

    public function employe() //relacion  con la tabla m:m 
    {
        return $this->belongsToMany('App\Employe','employe_cleaning')
       ->withPivot('employe_id','id');
    }
}
