<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = [
        'name', 'description', 'price',
    ];
    public function doctors()
    {
        return $this->belongsToMany('App\User');
    }
}
