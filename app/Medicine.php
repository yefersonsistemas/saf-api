<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $fillable = [
        'name', 'branch_id'
    ];
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }
    public function branch()
    {
        return $this->belongsToMany('App\Branch');
    }
}
