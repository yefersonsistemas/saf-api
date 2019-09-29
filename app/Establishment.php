<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $table = 'establishments';

    protected $fillable = [
        'name', 'coordinate', 'description', 'branch_id'
    ];
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
