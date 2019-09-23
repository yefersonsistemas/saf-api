<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'name', 'branchoffice_id'
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
}
