<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeArea extends Model
{
    protected $table = 'type_areas';

    protected $fillable = [ //saldo
        'name', 'description', 'branch_id'
    ];

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }

}
