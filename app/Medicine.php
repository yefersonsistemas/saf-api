<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'name',
    ];
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
}
