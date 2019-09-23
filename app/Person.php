<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [ //pagos
        'type_dni', 'dni', 'name', 'lastname', 'address', 'phone', 'email', 'branchoffice_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
}
