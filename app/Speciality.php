<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = 'specialities';

    protected $fillable = [
        'name', 'description', 'branch_id'
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

    public function employe()
    {
        return $this->hasMany('App\Speciality');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
