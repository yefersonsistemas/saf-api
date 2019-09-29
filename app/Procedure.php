<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $table = 'procedures';

    protected $fillable = [
        'name', 'description', 'price', 'branch_id'
    ];

    public function doctors()
    {
        return $this->belongsToMany('App\Employe');
    }
    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
