<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';

    protected $fillable = [
        'name', 'value', 'branch_id'
    ];

    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
