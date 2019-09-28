<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalGuide extends Model
{
    protected $fillable = [
        'name', 'path', 'description', 'branch_id'
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
