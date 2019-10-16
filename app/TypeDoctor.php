<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDoctor extends Model //clase del doctor en  popularidad
{
    protected $table = 'type_doctors';

    protected $fillable = [ //comision de acuerdo a la clase del doctor
        'name', 'comission', 'branch_id'
    ];

    public function employe()
    {
        return $this->hasmany('App\Employe');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function clase()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
