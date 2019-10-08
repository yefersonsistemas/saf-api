<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeArea extends Model
{
    protected $table = 'type_areas';

    protected $fillable = [ //saldo
        'name', 'description', 'branch_id'
    ];

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

    public function areas()
    {
        return $this->hasMany('App\Area');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }

}
