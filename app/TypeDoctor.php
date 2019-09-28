<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeDoctor extends Model //clase del doctor en  popularidad
{
    protected $table = 'type_doctors';

    protected $fillable = [ //pagos
        'name', 'comission', 'branch_id'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function clase()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
