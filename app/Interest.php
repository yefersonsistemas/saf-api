<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'employe_id', 'course_id', 'branchoffice_id' 
    ];
}
