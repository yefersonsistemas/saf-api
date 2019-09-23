<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'name', 'coordinate', 'description', 'branchoffice_id'
    ];
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
