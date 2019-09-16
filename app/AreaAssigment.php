<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaAssigment extends Model
{
    protected $fillable = [
        'user_id', 'Area_id', 'Branchoffice_id'
    ];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function areas()
    {
        return $this->belongsTo('App\Area');
    }

}
