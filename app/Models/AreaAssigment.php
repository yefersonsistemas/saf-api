<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaAssigment extends Model
{
    protected $fillable = [
        'user_id', 'Area_id', 'Branchoffice_id'
    ];
}
