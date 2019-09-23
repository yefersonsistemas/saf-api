<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'action', 'description', 'branchoffice_id'
    ];
    
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
