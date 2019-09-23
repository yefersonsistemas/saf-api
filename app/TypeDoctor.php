<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDoctor extends Model //clase del doctor en  popularidad
{
    protected $fillable = [ //pagos
        'name', 'comission', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function clase()
    {
        return $this->belongsTo('App\Doctor');
    }
}
