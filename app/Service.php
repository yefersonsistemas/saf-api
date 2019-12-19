<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name', 'description', 'branch_id'
    ];

    public function specialitie()
    {
        return $this->belongsTo('App\Speciality');
    }
}
