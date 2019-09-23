<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'branchoffice_id'
    ];

    public function doctors()
    {
        return $this->belongsToMany('App\Employe');
    }
}
