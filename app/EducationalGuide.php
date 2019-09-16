<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducationalGuide extends Model
{
    protected $fillable = [
        'name', 'path', 'description',
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }
}
