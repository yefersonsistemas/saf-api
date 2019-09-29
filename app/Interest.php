<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'employe_id', 'course_id', 'branch_id' 
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
