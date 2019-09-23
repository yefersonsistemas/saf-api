<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model //visitantes
{
    protected $fillable = [ //pagos
        'person_id', 'type_visitor', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

}
