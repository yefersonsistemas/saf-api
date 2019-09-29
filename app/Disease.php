<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'diseases';

    protected $fillable = [
        'name', 'branch_id'
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
