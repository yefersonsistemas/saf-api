<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $fillable = [
        'name', 'description', 'branchoffice_id'
    ];
    
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function patients()
    {
        return $this->hasMany('App\Patient');
    }
}
