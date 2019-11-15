<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //importamos

class Visitor extends Model //visitantes
{
    use SoftDeletes; //Implementamos 

    protected $dates = ['deleted_at']; //Registramos la nueva columna
    protected $table = 'visitors';
    
    protected $fillable = [
        'person_id', 'type_visitor', 'branch_id', 'inside', 'outside'
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function employe()
    {
        return $this->hasone('App\Employe');
    }

    public function position()
    {
        return $this->hasone('App\Position');
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
