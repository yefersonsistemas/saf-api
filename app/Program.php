<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'action', 'description', 'branch_id'
    ];
    
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
