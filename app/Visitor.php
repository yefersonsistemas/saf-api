<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model //visitantes
{
    protected $table = 'visitors';
    
    protected $fillable = [ //pagos
        'person_id', 'type_visitor', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

}
