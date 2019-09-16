<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'action', 'description', 'course_id',
    ];
    
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
