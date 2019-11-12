<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospitalization extends Model
{
    protected $table = 'hospitalization';

    protected $fillable = [
        'description', 'branch_id'
    ];

    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }
}
